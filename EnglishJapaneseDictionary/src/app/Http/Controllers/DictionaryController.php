<?php

namespace App\Http\Controllers;

use App\Models\WordMeaningAndTag; 
use Illuminate\Http\Request;
use Illuminate\View\View;

class DictionaryController extends Controller
{
    public function registerToDictionary(Request $request): View
    {
        //Tagが設定されなかった場合は、<none>をTagとする
        $tag = $request->get("tag");
        if ($tag === null)
            $tag = '<none>';
        
        //入力されたWordがDBに存在しない場合は新規作成し、存在する場合は更新する
        WordMeaningAndTag::query()->updateOrCreate(
            ['word' => $request->get("word")],
            ['meaning' => $request->get("meaning"), 'tag' => $tag]
        );

        return view('welcome');
    }

    public function showWordList(): View
    {
        //全てのWordを取得する
        $words = WordMeaningAndTag::query()
            ->select(['word', 'meaning', 'tag'])
            ->orderBy('word')
            ->get();

        return view('wordList', compact('words'));
    }

    public function showSearchPage(): View
    {
        //全てのTagを取得する
        $tags = WordMeaningAndTag::query()
            ->select('tag')
            ->orderBy('tag')
            ->distinct()
            ->pluck('tag');

        return view('searchPage', compact('tags'));
    }

    public function searchForWords(Request $request): View
    {
        $words = collect();
        
        foreach ($request->all() as $reqName => $reqValue) {
            if ($reqName !== "keyword_for_search") {
                //指定されたTagをもつWordを全て取得し、コレクションに追加する
                $words_tag_search = WordMeaningAndTag::query()
                    ->select(['word', 'meaning', 'tag'])
                    ->orderBy('word')
                    ->where('tag', '=', $reqValue)
                    ->get();

                foreach ($words_tag_search as $word) {
                    $words->add($word);
                }
            } elseif ($reqValue === null)
                //検索バーに何も入力されなかった場合は処理しない
                continue;
            else {
                //検索バーに入力された場合は、指定されたKeywordで検索する
                $word_searched_for = WordMeaningAndTag::query()
                ->select(['word', 'meaning', 'tag'])
                ->where('word', '=', $reqValue)
                ->first();

                //Keywordに一致するWordが存在する場合は、それを検索結果とする
                $word = $word_searched_for ?? new WordMeaningAndTag([
                    "word" => 'Not found',
                    "meaning" => '-',
                    "tag" => '-'
                ]);

                //Tagが指定され、すでに要素が存在する場合のために、コレクションを空にしてから追加する
                $words = collect();
                $words->add($word);
            }
        }

        return view('searchResult', compact('words'));
    }

    public function showEditPage(): View
    {
        //全てのWordを取得する
        $words = WordMeaningAndTag::query()
            ->select(['word', 'meaning', 'tag'])
            ->orderBy('word')
            ->get();

        return view('editPage', compact('words'));
    }

    public function showEditForm(Request $request): View
    {
        //編集対象のWordを取得する
        $wordToBeEdited = WordMeaningAndTag::query()
            ->select(['word', 'meaning', 'tag'])
            ->where('word', '=', $request->get('wordToBeEdited'))
            ->first();

        return view('editForm', compact('wordToBeEdited'));
    }

    public function editWord(Request $request): View
    {
        //Tagが設定されなかった場合は、<none>をTagとする
        $tag = $request->get("tag");
        if ($tag === null)
            $tag = '<none>';

        //編集対象のWordのMeaningとTagをそれぞれ指定された文言で更新する
        WordMeaningAndTag::query()
            ->where('word', '=', $request->get("word"))
            ->update([
                'meaning' => $request->get("meaning"),
                'tag' => $tag
            ]);
        
        //全てのWordを取得する
        $words = WordMeaningAndTag::query()
            ->select(['word', 'meaning', 'tag'])
            ->orderBy('word')
            ->get();
        
        return view('editPage', compact('words'));
    }

    public function resetDictionary(): View
    {
        //DBをリセットする
        WordMeaningAndTag::query()->delete();
        
        return view('welcome');
    }

    public function deleteWord(Request $request): View
    {   
        //指定されたWordを削除する
        WordMeaningAndTag::query()
            ->where('word', '=', $request->get("wordToBeDeleted"))
            ->delete();
        
        //全てのWordを取得する
        $words = WordMeaningAndTag::query()
            ->select(['word', 'meaning', 'tag'])
            ->orderBy('word')
            ->get();

        return view('editPage', compact('words'));
    }

    public function showTestSettingsPage(): View
    {
        //全てのTagを取得する
        $tags = WordMeaningAndTag::query()
            ->select('tag')
            ->orderBy('tag')
            ->distinct()
            ->pluck('tag');

        return view('testSettingsPage', compact('tags'));
    }

    public function showTestPage(Request $request): View
    {
        $words = collect();
        
        foreach ($request->all() as $reqName => $reqValue) {
            if ($reqName !== "order" && $reqName !== "wordCount") {
                //指定されたTagをもつWordを全て取得し、コレクションに追加する
                $words_tag_search = WordMeaningAndTag::query()
                    ->select(['word', 'meaning'])
                    ->where('tag', '=', $reqValue)
                    ->get();

                foreach ($words_tag_search as $word) {
                    $words->add($word);
                }
            } elseif ($reqName === "order") {
                if ($words->isEmpty()) {
                    //Tagが指定されなかった場合は、全てのWordを取得し、コレクションに追加する
                    $words_all = WordMeaningAndTag::query()
                        ->select(['word', 'meaning'])
                        ->get();

                    foreach ($words_all as $word) {
                        $words->add($word);
                    }
                }

                if ($reqValue === 'alphabetical') {
                    //取得した全てのデータをそれぞれのWordで紐付けし、アルファベット順に並べ替える
                    $keysForSort = collect();

                    foreach ($words as $word) {
                        $keysForSort->add($word->word);
                    }

                    $combined = $keysForSort->combine($words);

                    $words = $combined->sortKeys();
                } else
                    //取得したデータをシャッフルする
                    $words = $words->shuffle();
            } else {
                /*
                 * 単語数が指定されなかった場合と指定された単語数がデータ数以上の場合は何もせず、
                 * データ数未満の場合は指定数ランダムに抽出する
                 */
                if ($reqValue === null)
                    break;
                elseif ($words->count() > $reqValue)
                    $words = $words->random($reqValue);
                else
                    break;
            }
        }

        //選ばれた単語を単語帳に追加する
        $wordCards = [];

        foreach ($words as $word) {
            array_push($wordCards, $word->word, $word->meaning);
        }
        
        return view('testPage', compact('wordCards'));
    }
}