<?php
// Includes include("common.php");
// Game States define("GAME_START", 0);
define("GAME_PLAY", 1);
define("GAME_WIN", 2);
define("GAME_OVER", 3);
// Images
define("X_IMAGE", "images / X . gif");
define("O_IMAGE", "images / O . gif");
function Render()
{
    global $gGameState;
    global $gBoard;
    global $gDifficulty;
    switch ($gGameState) {
        case GAME_PLAY: {
                // Get the move if the user made one 
                if ($_POST['btnMove'] != "") {
                    $gBoard[$_POST['btnMove']] = "x";
                    $_SESSION['gBoard'] = $gBoard;
                }
                // Check for a win 
                if (CheckWin() == "X") {
                    $gGameState = GAME_WIN;
                    Render();
                    return;
                }
                // Check to see if the board is full
                if (CheckFull() == 1) {
                    $gGameState = GAME_OVER;
                    Render();
                    return;
                }
                // Compute the computer's move if we can still move 
                if ($gGameState == GAME_PLAY && $_POST['btnMove'] != "") {
                    if ($gDifficulty == 1) {
                        ComputerRandomMove();
                    } elseif ($gDifficulty == 2) {
                        $computerMove = ComputerMove();
                        if ($computerMove == "") {
                            ComputerRandomMove();
                        } else {
                            $_SESSION['gBoard'] = $gBoard;
                        }
                    } elseif ($gDifficulty == 3) {
                        $computerMove = ComputerMove();
                        if ($computerMove == '') { }
                        $gBoard[$computerMove] = "o";
                        if ($gBoard[4] == '') $computerMove = 4;
                        elseif ($gBoard[0] == '') $computerMove = 0;
                        elseif ($gBoard[2] == '') $computerMove = 2;
                        elseif ($gBoard[6] == '') $computerMove = 6;
                        elseif ($gBoard[8] == '') $computerMove = 8;
                        if ($computerMove == '') ComputerRandomMove();
                    }
                }
            }
            // Check for a win 
            if (CheckWin() == "O") {
                $gGameState = GAME_OVER;
                Render();
                return;
            }
            // Check to see if the board is full 
            if (CheckFull() == 1) {
                $gGameState = GAME_OVER;
                Render();
                return;
            }
            // Draw the board 
            DrawBoard();
            break;
        case GAME_WIN: {
                EndGame();
                break;
            }
        case GAME_OVER: {
                EndGame();
                break;
                // Update our game state
                $_SESSION['gGameState'] = $gGameState;
            }
    }
    $_SESSION['gGameState'] = $gGameState;
}
if ($_POST['dlDifficulty'] != "") {
    $gDifficulty = $_POST['dlDifficulty'];
    EndGame();
    $gGameState = GAME_START;
    StartGame();
}
if ($gGameState == GAME_START) {
    StartGame();
}
// Check to see if the user is starting a new game 
if ($_POST['btnNewGame'] != "") {
    EndGame();
    $gGameState = GAME_START;
    StartGame();
}
function StartGame()
{
    global $gGameState;
    global $gBoard;
    if ($gGameState == GAME_START) {
        $gGameState = GAME_PLAY;
    }
    // use $_SESSION instead of session_register due to security issues 
    session_start();
    $turn = $_SESSION['turn'];
    if (!isset($turn)) {
        $turn = 1;
        $gBoard = array("", "", "", "", "", "", "", "", "");
        $_SESSION['gGameState'] = $gGameState;
        $_SESSION['gBoard'] = $gBoard;
        $_SESSION['gDifficulty'] = $gDifficulty;
        $_SESSION['turn'] = $turn;
    }
    // Retrieve the board state 
    $gBoard = $_SESSION['gBoard'];
    // Get the difficulty level
    $gDifficulty = $_SESSION['gDifficulty'];
}
function EndGame()
{
    global $gGameState;
    global $gBoard;
    $gGameState = GAME_OVER;
    unset($gBoard);
    unset($gGameState);
    unset($turn);
    session_destroy();
}
function DrawBoard()
{ 
    global $gBoard;
// Start the table
printf("<table border=0 cellpadding=0 cellspacing=0>");
$iLoop = 0;
for($iRow = 0; $iRow < 5; $iRow++) {
printf("<tr>\n");
for($iCol = 0; $iCol < 5; $iCol++) {
if($iRow == 1 || $iRow == 3) {
} else {
printf("<td width=\"12\" height=\"5\" align=\"center\" valign=\"middle\" bgcolor=\"#000000\">&nbsp;</td>\n");
if($iCol == 1 || $iCol == 3) {
    printf("<td width=\"12\" height=\"115\" align=\"center\" valign=\"middle\" bgcolor=\"#000000\">&nbsp;</td>\n");
} else {
printf("<td width=\"115\" height=\"115\" align=\"center\" valign=\"middle\">");
if($gBoard[$iLoop] == "x") {
printf("<img src=\"" . X_IMAGE . "\">"); }
elseif($gBoard[$iLoop] == "o") {
printf("<img src=\"" . O_IMAGE . "\">"); }
else {
printf("<input type=\"submit\" name=\"btnMove\" \ value=\"" .$iLoop . "\">");
 }
printf("</td>\n");
$iLoop++; }
}
}
printf("</tr>\n"); }
// End the table
printf("</table>"); }
DrawBoard();
?>
<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>

<head>
    <title>Tic-Tac-Toe</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <form action="index.php" method="post">
        <input type="hidden" name="turn" value="<? printf($turn) ?>">
        <?php ; ?>
        <div align="center">
            <input type="submit" name="btnNewGame" value="New Game">&nbsp;&nbsp;&nbsp;
            <b>Difficulty Level</b> <select name="dlDifficulty">
                <option value="1">Easy</option>
                <option value="2" SELECTED>Normal</option>
                <option value="3">Not-Likely</option>
            </select><br><br> <?php
                                // Render the game
                                Render(); ?>
        </div>
        <?php ; ?> </form>
</body>

</html>
