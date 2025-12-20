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

        $contactData = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);

        $tel = $request->tel1 . $request->tel2 . $request->tel3;
        $request->merge(['tel' => $tel]);

        Contact::create($contactData);

        return redirect()->route("contact.thanks");
    }

    public function thanks()
    {
        return view("contact.thanks");
    }
}
