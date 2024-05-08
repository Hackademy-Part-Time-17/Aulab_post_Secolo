<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;



class AdminController extends Controller
{
    public function dashboard(){
        $adminRequest=User::where('is_admin',NULL)->get();
        $revisorRequest=User::where('is_revisor',NULL)->get();
        $writerRequest=User::where('is_writer',NULL)->get();

        return view('admin.dashboard',compact('adminRequest','revisorRequest','writerRequest'));
    }

    public function setAdmin(User $user){
        $user->update(['is_admin'=>true]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente reso amministratore l\'utente scelto !');
    }

    public function setRevisor(User $user){
        $user->update(['is_revisor'=>true]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente reso revisore l\'utente scelto !');
    }

    public function setWriter(User $user){
        $user->update(['is_writer'=>true]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente reso redattore l\'utente scelto !');
    }

    public function editTag(Request $request,Tag $tag){
        $request->validate(['name'=>'required|unique:tags']);//con unique:tags abbiamo affermato che non deve esistere un altro valore uguale nella colonna name della tabella tags
        $tag->update(['name'=>strtolower($request->name),]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente aggiornato il tag');
    }

    public function deleteTag(Tag $tag){
        foreach($tag->articles as $article){
            $article->tags()->detach($tag);//elimina le relazioni con le altre tabelle
        }
        $tag->delete();
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente eliminato il tag');
    }

    public function editCategory(Request $request,Category $category){
        $request->validate(['name'=>'required|unique:categories']);//con unique:tags abbiamo affermato che non deve esistere un altro valore uguale nella colonna name della tabella tags
        $category->update(['name'=>ucWords(strtolower($request->name)),]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente aggiornato la categoria');
    }

    public function deleteCategory(Category $category){
        $category->delete();//non c’è stato bisogno di gestire il vincolo d’integrità referenziale perché ne abbiamo gestito il comportamento direttamente nelle migrazioni.
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente eliminato la categoria');
    }

    public function storeCategory(Request $request){
        Category::create(['name'=>ucWords(strtolower($request->name))]);
        return redirect(route('admin.dashboard'))->with('message','Hai correttamente inserito una nuova categoria');
    }
}