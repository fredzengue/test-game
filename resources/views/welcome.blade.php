<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TIC-TAC-TOE</title>
    <style>
        .game-app{
    width: 50%;
    margin: auto;
    box-shadow: 0 0px 7px 1px rgb(0 0 0 / 15%);
    border-radius: 10px;
    color: #545554;
    margin-top: 60px;
}
ul{
    list-style: none;
    position: absolute;
    top: 60px;
}
li{
    cursor: pointer;
}
.hide{
    display: none;
}
li.selected::before{
    content: "\25bc";
    margin-right: 5px;
    font-size: 13px;
}
table{
    width: max-content;
    margin: auto;
    text-align: center;
    border-collapse: collapse;
}
.game-header{
    padding-top: 40px;
}
.game-team{
    width: 50%;
    margin: auto;
    display: grid;
    grid-template-columns: 48% 48%;
    column-gap: 2%;

}
.game-team button.play{
    border-bottom: 3px solid #00a293;
}
.game-team button{
    font-size: 16px;
    border-radius: 10px;
    padding: 4% 10px;
    box-shadow: 0px 1px 1px 1px rgb(0 0 0 / 15%);
    border: none;
    background-color: transparent;
    text-align: left;
    text-decoration: none;
    display: grid;
    grid-template-columns: 50% 50%;
    cursor: pointer;
}
.game-team button:first-of-type:before{
    font-weight: bold;
    content: "\00D7";
    text-align: left;
}
.game-team button:last-of-type:before{
    font-weight: bold;
    content: "\25EF";
    text-align: left;
}
.game-team button::after{
    content: "\2212";
    text-align: right;
}
.game-body{
    background-color: #00bdad;
    padding: 15px 0;
}
.game-bottom{
    padding: 10px 0;
}
.game-bottom a{
    text-align: center;
    color: #00bdad;
    text-decoration: none;
    display: block;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
}
td{
    border-right: 5px solid #00a293;
    width: 50px;
    height: 50px;
    padding: 0;
    font-size: 60px;
    font-weight: bold;
    line-height: 0;
    letter-spacing: 0;
}
td:last-of-type{
    border-right: none;
}
tr{
    border-bottom: 5px solid #00a293;
    padding: 0;
}
tr:last-of-type{
    border-bottom: none;
}
.game-header p{
    text-align: center;
}

a.disabled{
    color: #545554;
    cursor: not-allowed;
}
.winner
{
    text-align: center;
    font-size: 11em;
    line-height: 0.5;
    margin: 0;
}
.game-body .message{
    text-align: center;
    text-transform: uppercase;
}
.light {
    color: #fff;
}

    </style>
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

    <script src="{{ asset('js/') }}/app.js" defer></script>
</body>

</html>
