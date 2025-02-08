<?php

//questo è un controller di test, solo per la verifica del corretto autorouting
//non ha alcuna funzione pratica

// nome del controller deve essere in CamelCase
// nome del file deve essere in PascalCase
// il nome del file, dà il nome al percoso.
// quindi se il file si chiama Test.php, il percorso sarà /test
// se il file si chiama TestDiProva.php, il percorso sarà /test-di-prova
// il metodo del controller dà il nome all'azione
// quindi se il metodo si chiama getIndex, il percorso sarà /test
// se il metodo si chiama getAltroTest, il percorso sarà /altro-test

// i metodi del controller possono essere di 3 tipi:
// - get: per le richieste GET
// - post: per le richieste POST
// - any: per tutte le richieste


namespace App\Controllers;


class Test extends BaseController
{
    public function getIndex()
    {
        return view('welcome_message');
    }

    public function getAltrotest()
    {
        return view('welcome_message');
    }

    public function postTestDiProva()
    {
        return view('welcome_message');
    }
}