<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            //Nelle relazioni many to many devo creare due foreign keys corrispondenti alle due tabelle che collega

            $table->unsignedBigInteger('post_id'); //creo la colonna della foreign key
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); 
            //specifico che la colonna della foreign key sarà corrispondente alla colonna id della tabella posts
            //onDelete('cascade') quindi quando cancello un post, cancellando il suo id, cancello anche tutti i collegamente di quel post all'altra tabella perché intanto non esiste più

            $table->unsignedBigInteger('tag_id'); 
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // devo specificare che nella tabella pivot la coppia post_id e tag_id deve essere la chiave primaria univoca, quindi non posso salvare coppie che hano gli stessi id
            $table->primary(['post_id', 'tag_id']); //in questo modo creo la chiave primaria formata dalla coppia dei due valori specificati
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
