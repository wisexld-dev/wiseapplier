<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function runScript()
    {
        $command = escapeshellcmd('python scripts/script.py');
        $output = shell_exec($command);

        return view('script_output', ['output' => $output]);
    }
}
