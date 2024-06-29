<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//Per prendere i dati dell'utente autenticato 
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','show');
    }
    public function index()
    {//mostriamo all'utente autenticato tutti gli articoli ordinati dal più recente
        $articles=Article::where('is_accepted',true)->orderBy('created_at','DESC')->get();
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|min:5|unique:articles',
            'subtitle'=>'required|min:5|unique:articles',
            'body'=>'required|min:10',
            'image'=>'image|required',
            'category'=>'required',
            'tags'=>'required',
        ]);

        $article=Article::create([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'body'=>$request->body,
            'image'=>$request->file('image')->store('public/images'),
            'category_id'=>$request->category,
            'user_id'=>Auth::user()->id,
            'slug'=>Str::slug($request->title),
        ]);
       
        $tags=strtolower(str_replace(' ','',$request->tags));
        $tags=str_replace('#','',$tags);
        //con str_replace rimuovo tutti gli spazi nella stringa
        $tags=explode(',' ,$tags);
        foreach($tags as $tag){
            $newTag=Tag::updateOrCreate(
                ['name'=>$tag],
            );
            $article->tags()->attach($newTag);
            //attach() è la funzione che crea effettivamente il record all’interno della tabella pivot, quindi crea la relazione.
        }
        return redirect(route('homepage'))->with('message','Articolo creato correttamente');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {//mostra la vista del singolo articolo in dettaglio
        return view('article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function byCategory(Category $category)
    {   
        $articles=$category->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted==true;
        });//usiamo filter e non where perchè non stiamo prendendo gli articoli facendo una query al database, ma essendo il risultato di una relazione una collezione
        return view('article.by-category',compact('category','articles'));//filter cicla ogni singolo oggetto all’interno della collezione e restituisce solo quelli che rispettano una determinata condizione
    }

    public function byWriter(User $user)
    {
        $articles=$user->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted==true;
        });
        return view('article.by-writer',compact('user','articles'));
    }

    public function articleSearch(Request $request){
        $query=$request->input('query');
        $articles=Article::search($query)->where('is_accepted',true)->orderBy('created_at','DESC')->get();
        return view('article.search-index',compact('articles','query'));

    }

    public function edit(Article $article)
    {
        return view('article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'=>'required|min:5|unique:articles,title,'.$article->id,
            'subtitle'=>'required|min:5|unique:articles,subtitle,'.$article->id,//non dimenticare mai di mettere la virgola dopo il noe della colonna
            // nei campi title e subtitle abbiamo fatto un’aggiunta alla regola unique che ci consente di ignorare l’articolo che stiamo aggiornando.
            //Abbiamo dovuto farlo perché questa regola controlla se un dato elemento è già presente nel db,quindi avrebbe accettato solo con modifiche in quei due campi che, magari, non vogliamo modificare;
            'body'=>'required|min:10',
            'image'=>'image',           
            'category'=>'required',
            'tags'=>'required',
        ]);
        $article->update([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'body'=>$request->body,
            'category_id'=>$request->category,
            'slug'=>Str::slug($request->title),
        ]);    
            if($request->image){
                Storage::delete($article->image);
                $article->update(
                    ['image'=>$request->file('image')->store('public/images'),
                    ]);
            }
        $tags=strtolower(str_replace(' ','',$request->tags));
        $tags=str_replace('#','',$tags);

        $tags=explode(',' ,$tags);
        //dopo aver lanciato explode() sui tags arrivati dalla request, abbiamo creato un array di appoggio.
        $newTags=[];
        foreach($tags as $tag){
            $newTag=Tag::updateOrCreate(
                ['name'=>$tag],
            );
            $newTags[]=$newTag->id;
        }
        $article->tags()->sync($newTags);

        //gli id salvati nell'array vengono passati alla funzione `sync()` che ci gestisce automaticamente la relazione Many-to-Many tra Article e Tag: con tutti gli id presenti nell’array, effettuerà un `attach()`, con quelli non presenti effettuerà un `detach()`.
        //Questo ci permetterà di tenere tutte le relazioni ordinate.
        return redirect(route('homepage'))->with('message','Hai correttamente aggiornato l\'articolo !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        foreach($article->tags as $tag){
            $article->tags()->detach($tag);
        }
        $article->delete();
    return redirect(route('writer.dashboard'))->with('message','Hai correttamente cancellato l\'articolo scelto');

    }
}
