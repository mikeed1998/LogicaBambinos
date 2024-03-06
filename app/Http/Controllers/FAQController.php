<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;


class FAQController extends Controller
{
    public function index() {
        $faqs = Faq::all();
        return view('config.faqs.index', compact('faqs'));
    }

    public function create() {
        return view('config.faqs.create');
    }

    public function store(Request $request)
    {
        $faq = new Faq;

        $faq->pregunta = $request->pregunta;
        $faq->respuesta = $request->respuesta;
        $faq->save();

        return redirect()->route('faqs.index');
    }

    public function show($id) {
        $faq = Faq::find($id);
        return view('config.faqs.show', compact('faq'));
    }

    public function edit($id) {
        $faq = Faq::find($id);
        return view('config.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id) {
        $faq = Faq::find($id);

        $faq->pregunta = $request->pregunta;
        $faq->respuesta = $request->respuesta;
        $faq->update();

        return redirect()->route('faqs.index');
    }

    public function destroy($id) {
        $faq = Faq::find($id);
        $faq->delete();
    }
}
