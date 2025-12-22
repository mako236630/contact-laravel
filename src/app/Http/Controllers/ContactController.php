<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view("contact.index", compact("categories"));
    }

    public function confirm(ContactRequest $request)
    {
        $data = $request->validated();

        $category = Category::find($data['category_id']);

        $data['category_content'] = $category->content;

        return view("contact.confirm", compact("data"));
    }

    public function store(Request $request)
    {
        if ($request->input('back')) {
            return redirect('/')->withInput();
        }

        $contact = $request->all();

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        Contact::create($contact);

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view("contact.thanks");
    }

    public function admin()
    {
        $contacts = Contact::with("category")->paginate(7);

        $categories = Category::all();

        return view("admin", compact("contacts", "categories"));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect("admin");
    }

    public function search(Request $request)
    {
        $query = Contact::with('category'); // カテゴリ情報も一緒に取得

        // 1. 名前・メールアドレス検索 (FN022)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    // 姓と名を結合して検索（フルネーム検索への対応）
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('CONCAT(last_name, " ", first_name) LIKE ?', ['%' . $keyword . '%']);
            });
        }

        // 2. 性別検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 3. お問い合わせの種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 7件ごとにページネーション (FN021)
        $contacts = $query->paginate(7);

        // 検索に必要なカテゴリ一覧を再取得
        $categories = \App\Models\Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
