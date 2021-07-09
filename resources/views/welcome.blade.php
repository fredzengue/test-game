<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TIC-TAC-TOE</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    @if ($game != null)
        @if (sizeof($game->lastmoves) != 0)
            <div class="game-app" id="{{ $game->matchId }}"
                data-team="{{ $game->lastmoves()->orderBy('created_at', 'DESC')->first()->char }}"
                data-board="{{ $game->boardState }}">
            @else
                <div class="game-app" id="{{ $game->matchId }}" data-team="" data-board="{{ $game->boardState }}">
        @endif

        @else
        <div class="game-app" id="" data-team="" data-board="">
    @endif


    <div class="game-container">
        <div class="game-header">
            <ul>
                <li class="selected">Facile</li>
                <li class="hide">Moyen</li>
                <li class="hide">Difficile</li>
            </ul>
            <div class="game-team">
                <button data-team="0" disabled></button>
                <button data-team="1" disabled></button>
            </div>
            <p>Appuyer sur lancer pour commencer une partie</p>
        </div>
        <div class="game-body">
            <table>
                @if ($game == null)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        @foreach (array_slice(boardState($game->boardState), 0, 3) as $line)
                            @switch($line)
                                @case('X')
                                    <td>
                                        &#215;
                                    </td>
                                @break
                                @case('O')
                                    <td class="light">
                                        &#9675;
                                    </td>

                                @break
                                @default
                                    <td>
                                    </td>
                            @endswitch
                        @endforeach
                    </tr>
                    <tr>
                        @foreach (array_slice(boardState($game->boardState), 3, 3) as $line)

                            @switch($line)
                                @case('X')
                                    <td>
                                        &#215;
                                    </td>
                                @break
                                @case('O')
                                    <td class="light">
                                        &#9675;
                                    </td>

                                @break
                                @default
                                    <td>
                                    </td>
                            @endswitch
                        @endforeach
                    </tr>
                    <tr>
                        @foreach (array_slice(boardState($game->boardState), 6, 3) as $line)
                            @switch($line)
                                @case('X')
                                    <td>
                                        &#215;
                                    </td>
                                @break
                                @case('O')
                                    <td class="light">
                                        &#9675;
                                    </td>

                                @break
                                @default
                                    <td>
                                    </td>
                            @endswitch
                        @endforeach
                    </tr>
                @endif

            </table>
        </div>
        <div class="game-bottom">
            <a href="#">Lancer</a>
        </div>
    </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
