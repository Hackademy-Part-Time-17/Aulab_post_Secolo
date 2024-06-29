<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
/**
 * Searchable ci da accesso a una funzione  che restituirà un array con la specifica di quali campi vogliamo indicizzare e quali sono i loro valori.
 */

class Article extends Model
{
    use HasFactory,Searchable;
    
    protected $fillable=[
        'title',
        'subtitle',
        'body',
        'image',
        'user_id',
        'category_id',
        'is_accepted',
        'slug',
    ];
    
    public function toSearchableArray()
    {
    /*Se ci trovassimo a modificare il modello Article o la funzione `toSearchableArray()`, ricordiamoci prima di cancellare l’indicizzazione del nostro database con il comando:
        php artisan scout:flush "App\Models\Article"
    
    Solo dopo, potremo rilanciare:
        php artisan scout:import "App\Models\Article"
    */
        $array = $this->toArray();
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'subtitle'=>$this->subtitle,
            'category'=>$this->category,
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function readDuration(){
        $totalWords=str_word_count($this->body);//con str_word_count() contiamo il numero delle parole presenti all’interno del corpo del nostro articolo;
        $minutesToRead=round($totalWords/200);//con round() andiamo ad arrotondare per eccesso i minuti che ci vogliono per leggere il testo (La media di una persona scolarizzata sono 200 parole al minuto). Questo ci restituirà però un dato di tipo float;
        return intval($minutesToRead);//è per questo che nel return utilizziamo il metodo intval, che recupera il valore intero di una data variabile.
    }
}
