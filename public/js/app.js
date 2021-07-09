
$(document).ready(function () {
    let player = 8;
    let team1 = '';
    let team2 = '';
    let finish = 9;
    let test = 'true';
    let i = 0;
    let light = '';
    let board_state = [
        "-", "-", "-",
        "-", "-", "-",
        "-", "-", "-"
    ];
    let match_id = 0;
    let last_move = 11;
    //make a select dropdown to choose level
    $('li').click(function () {
        $('li').toggleClass('hide');
        $(this).removeClass('hide');
        $("li").removeClass('selected');
        $(this).addClass('selected');
        $('li:first-of-type').before($(this));
    })
    if ($('.game-app').attr('id') != 'null') {
        player = 1;
        switch ($('.game-app').attr('data-team')) {
            case "O":
                $('.game-team button:first-of-type').addClass('play');
                $('.game-header p').html("c'est à &#9675; de jouer");
                light = 'team1';
                team1 = '&#9675;';
                team2 = '&#215;';
                break;
            case "X":
                $('.game-team button:last-of-type').addClass('play');
                $('.game-header p').html("c'est à &#215; de jouer");
                light = 'team2';
                team1 = '&#215;';
                team2 = '&#9675;';
                break;

            default:
                player = 8;
                break;
        }
        if ($('.game-app').attr('data-team') == "O") {

        } else {

        }
        var str = $('.game-app').attr('data-board');
        str.split(",", 9);
        board_state = str.split(",", 9);
        for (let index = 0; index < board_state.length; index++) {
            const element = board_state[index];
            if (element != '-') {
                finish--;
            }
        }
        match_id = $('.game-app').attr('id');
    }
    _clickEvents();
    function _clickEvents() {

        $('.game-bottom a').click(function (e) {
            e.prevenDefault;

            $('.game-team button').removeClass('play');
            $('.game-team button').attr("disabled", 'true');
            newGame();
            if (Math.floor(Math.random() * 2) == 0) {
                player = 0;
                var team = Math.floor(Math.random() * 2);
                if (team == 0) {
                    team1 = '&#215;';
                    team2 = '&#9675;';
                    light = 'team2';
                    $('.game-team button:first-of-type').addClass('play');
                    $('.game-header p').html("c'est à &#215; de jouer");
                    setTimeout(function () {
                        cpuPlaying();
                    }, 3000);
                } else {
                    team1 = '&#9675;';
                    team2 = '&#215;';
                    light = 'team1';
                    $('.game-team button:last-of-type').addClass('play');
                    $('.game-header p').html("c'est à &#9675; de jouer");
                    setTimeout(function () {
                        cpuPlaying('&#9675;');
                    }, 3000);
                }
            } else {
                $('.game-header p').html("Choisissez une équipe!");
                $('.game-team button').removeAttr('disabled');
                $('.game-team button').click(function () {
                    player = 1;
                    if ($('.game-team button:first-of-type').hasClass('play') == false & $('.game-team button:last-of-type').hasClass('play') == false) {
                        $(this).addClass('play');
                        var team = $(this).attr('data-team');
                        if (parseInt(team) == 0) {
                            team2 = '&#215;';
                            team1 = '&#9675;';
                            light = 'team1';
                            $('.game-header p').html("c'est à &#215; de jouer");
                        } else {
                            team2 = '&#9675;';
                            team1 = '&#215;';
                            light = 'team2';
                            $('.game-header p').html("c'est à &#9675; de jouer");
                        }

                    }

                    $('.game-team button').attr('disabled', 'true');
                });
            }
        });
        if (i < 9) {
            $('td').click(function () {
                test = 'true';
                switch ($(this).closest('tr').index()) {
                    case 0:
                        var choice = $(this).index();
                        break;
                    case 1:
                        var choice = $(this).index() + 3;
                        break;
                    case 2:
                        var choice = $(this).index() + 6;
                        break;

                    default:
                        break;
                }
                if (player == 1) {
                    if (board_state[choice] == "-") {
                        $(this).html(team2);
                        if (team2 == '&#9675;') {
                            board_state[choice] = 'O';
                            // saveGame('O');
                        } else {
                            board_state[choice] = 'X';
                            //saveGame('X');
                        }

                        last_move = choice;
                        ;
                        if (light == 'team2') {
                            $(this).addClass('light');
                        }
                        player = 0;
                        if (gameStatus(team2)) {
                            test = 'false';
                            player = 1;
                        }
                        $('.game-header p').html("c'est à " + team1 + " de jouer");
                        finish--;
                        if ($('.game-team button:first-of-type').hasClass('play') == false) {
                            $('.game-team button:last-of-type').removeClass('play');
                            $('.game-team button:first-of-type').addClass('play');
                            $('.game-header p').html("c'est à " + team1 + " de jouer");
                        } else {
                            $('.game-team button:first-of-type').removeClass('play');
                            $('.game-team button:last-of-type').addClass('play');
                            $('.game-header p').html("c'est à " + team1 + " de jouer");
                        }
                        i++;

                        if (player == 0) {
                            setTimeout(function () {
                                cpuPlaying();
                            }, 3000);
                        }

                    }
                }
            });
        }
    }



    function cpuPlaying() {

        var choice = 11;
        while (test == 'true') {
            choice = Math.floor(Math.random() * 9) + 1;
            for (let index = 0; index < board_state.length; index++) {
                if (board_state[index] == "-" & index == choice - 1) {
                    test = 'false';
                    if (team1 == '&#9675;') {
                        board_state[index] = 'O';
                        saveGame('O');
                    } else {
                        board_state[index] = 'X';
                        saveGame('X');
                    }
                    last_move = choice;
                    finish--;
                }

            }
        }
        $('td').eq(choice - 1).html(team1);
        if (light == 'team1') {
            $('td').eq(choice - 1).addClass('light');
        }
        if (gameStatus(team1)) {
            test = 'false';
        }
        if ($('.game-team button:first-of-type').hasClass('play') == false) {
            $('.game-team button:last-of-type').removeClass('play');
            $('.game-team button:first-of-type').addClass('play');
            $('.game-header p').html("c'est à " + team2 + " de jouer");
        } else {
            $('.game-team button:first-of-type').removeClass('play');
            $('.game-team button:last-of-type').addClass('play');
            $('.game-header p').html("c'est à " + team2 + " de jouer");
        }

        i++;
        player = 1;
    }
    function gameStatus(team) {

        if (
            (board_state[0] == "-" & board_state[0] == board_state[1] & board_state[0] == board_state[2]) |
            (board_state[0] == "-" & board_state[0] == board_state[4] & board_state[0] == board_state[8]) |
            (board_state[0] == "-" & board_state[0] == board_state[3] & board_state[0] == board_state[6]) |
            (board_state[1] == "-" & board_state[1] == board_state[4] & board_state[1] == board_state[7]) |
            (board_state[2] == "-" & board_state[2] == board_state[4] & board_state[2] == board_state[6]) |
            (board_state[2] == "-" & board_state[2] == board_state[5] & board_state[2] == board_state[8]) |
            (board_state[3] == "-" & board_state[3] == board_state[4] & board_state[3] == board_state[5]) |
            (board_state[6] == "-" & board_state[6] == board_state[7] & board_state[6] == board_state[8])
        ) {
            return false;
        } else if (
            (board_state[0] == board_state[1] & board_state[0] == board_state[2]) |
            (board_state[0] == board_state[4] & board_state[0] == board_state[8]) |
            (board_state[0] == board_state[3] & board_state[0] == board_state[6]) |
            (board_state[1] == board_state[4] & board_state[1] == board_state[7]) |
            (board_state[2] == board_state[4] & board_state[2] == board_state[6]) |
            (board_state[2] == board_state[5] & board_state[2] == board_state[8]) |
            (board_state[3] == board_state[4] & board_state[3] == board_state[5]) |
            (board_state[6] == board_state[7] & board_state[6] == board_state[8])
        ) {
            $('.game-body').html(
                `
                <h1 class="winner">`+ team + `</h1>
                <h1 class="message">Gagne!</h1>
                `
            );
            if (team == '&#9675;') {
                $('.game-body').html(
                    `
                    <h1 class="winner light">`+ team + `</h1>
                    <h1 class="message">Gagne!</h1>
                    `
                );
            }

            return true;
        } else if (finish == 0) {
            $('.game-body').html(
                `
                <h1 class="winner">`+ team2 + `<span class="light">` + team1 + `</h1>
                <h1 class="message">Match Null!</h1>
                `
            );
            if (team2 == '&#9675;') {
                $('.game-body').html(
                    `
                    <h1 class="winner">`+ team1 + `<span class="light">` + team2 + `</h1>
                    <h1 class="message">Match Null!</h1>
                    `
                );
            }

            return true;
        }
        return false;

    }
    function saveGame(team) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(
            `/playing/${match_id}`,
            {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "apllication/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'patch',
                body: JSON.stringify({
                    match_id: match_id,
                    board_state: board_state,
                    last_move: last_move,
                    team: team
                })
            }
        ).then((data) => {
            console.log(data);
        }).catch((error) => {
            console.log(error);

        })

    }
    function newGame() {
        player = 8;
        i = 0;
        finish = 9;
        test = 'true';
        board_state = [
            "-", "-", "-",
            "-", "-", "-",
            "-", "-", "-"
        ];
        $('.game-body').html(
            ` <table>
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
            </table>`
        );
        $('.game-bottom a').html('Rejouer');
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajax({
            url: "/jouer/${rowId}",
            headers: {
                "Content-Type": "application/json",
                "Accept": "apllication/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            method: "PATCH"
        }).done(function (data) {
            result = JSON.parse(data);
            match_id = result.match_id;
        }).fail(function (error) {
            console.log(error);
        });
        _clickEvents();
    }
})
