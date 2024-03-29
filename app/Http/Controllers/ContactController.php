<?php
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
  
class ContactController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('contactForm');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            //'phone' => 'required|numeric',
            //'subject' => 'required',
            'message' => 'required'
        ]);
  
        Contact::create($request->all());
  
        return response()->json(['success' => 'Thank you for contact us. We will contact you shortly.']);
    }

    public function getAll(Request $request)
    {
        return response()->json(Contact::all());
    }

    public function get(Contact $contact)
    {
        return response()->json($contact);
    }

    public function delete (){

    }
}