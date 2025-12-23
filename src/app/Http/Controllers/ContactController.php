<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;


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
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('CONCAT(last_name, " ", first_name) LIKE ?', ['%' . $keyword . '%']);
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);

        $categories = \App\Models\Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request)
    {
        $query = Contact::with("category");

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();

        return new StreamedResponse(function () use ($contacts) {
            $stream = fopen('php://output', 'w');
            fputs($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($stream, ['お名前', '性別', 'メールアドレス', 'お問い合わせ内容']);

            foreach ($contacts as $contact) {
                $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
                fputcsv($stream, [
                    $contact->last_name . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->detail
                ]);
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);
    }

    public function reset()
    {
        return redirect()->route('admin');
    }
}
