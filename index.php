<!-- PHP Snack 1:
Creiamo un array 'matches' contenente altri array i
quali rappresentano delle partite di basket di
un’ipotetica tappa del calendario. Ogni array della
partita avrà una squadra di casa e una squadra
ospite, punti fatti dalla squadra di casa e punti fatti
dalla squadra ospite.
Stampiamo a schermo tutte le partite con questo
schema:
Olimpia Milano - Cantù | 55 - 60 -->
<!-- potremmo inserire una key point e dargli il valore assegnato e richiamarlo, ma si è scelto di integrare il mt_rand() cosi da avere valori random per ciclo e non ripeterli per singolo match -->
<?php
  $matches= array(
    ["homeTeam" => "Olimpia Milano","visitorTeam" => "Cantù" ],
    ["homeTeam" => "Cremona","visitorTeam" => "Virtus Bologna"],
    ["homeTeam" => "Trieste","visitorTeam" => "Varese"],
    ["homeTeam" => "Trento","visitorTeam" => "Fortitudo Bologna"],
    ["homeTeam" => "Brescia","visitorTeam" => "Universo Treviso"],
  );

  /* Soluzione 2 generazione randomica sia dei punti che dei matches */

  /* Generazione teamRandom */
  $teams = ["Olimpia Milano","Cantù","Cremona","Virtus Bologna","Trieste","Varese","Trento","Brescia","Fortitudo Bologna","Universo Treviso"];
  $randomMatchPointHome= mt_rand(0,150);
  $randomMatchPointVisitor= mt_rand(0,150);
  $homeTeam=[];
  $visitorTeam=[];

//generazione random dei setTeams
  while(count($homeTeam) < count($teams)/2) {
    $i = array_rand($teams);
    $team = $teams[$i];
    #var_dump($team);
    if (!in_array($team,$homeTeam)) {
      $homeTeam[] = $team;
    }
    #var_dump($homeTeam);
  };

  while (count($visitorTeam) < count($teams) / 2) {
    $team = $teams[array_rand($teams)];
    if (!in_array($team, $homeTeam) && !in_array($team,$visitorTeam)) {$visitorTeam[] = $team;};
  };
  #var_dump($visitorTeam);

  class match
  {
    public $homeTeam;
    public $visitorTeam;
    public $homePoits;
    public $visitorPoits;
    //public mi permette di accedere alla risorsa esternamente 
    public function __construct($team1,$team2,$poits1,$poits2){
      $this->homeTeam = $team1;
      $this->visitorTeam = $team2;
      $this->homePoits = $poits1;
      $this->visitorPoits = $poits2;
    }
  };

  for ($a=0; $a < (count($homeTeam)+count($visitorTeam))/2; $a++) {
    $match_iesimo = new match($homeTeam[$a],$visitorTeam[$a],$randomMatchPointHome,$randomMatchPointVisitor);
    $giornataX[] = $match_iesimo;
  }

  var_dump($giornataX);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Snack</title>
</head>
<body>
  <h1>🏀 Risultati LBA 🏀</h1>
  <h2>🏆 2° Giornata - Andata 🏆 </h2>
  <ul>
    <?php
      //dichiaro le variabili direttamente nel ciclo for $i e $size
      for ($i = 0, $size = count($matches); $i < $size; ++$i){
        $match = $matches[$i];
        echo  "<li>".$match["homeTeam"] ." - " .$match["visitorTeam"] ." | " .$matchPointHome = mt_rand(0,150) ." - ". $matchPointVisitor = mt_rand(0,150) ."</li>";
      }
    ?>  
  </ul>
  <br>
  <h2>🏆 3° Giornata - Andata 🏆 </h2>
  <ul>
    <?php
      //dichiaro le variabili direttamente nel ciclo for $i e $size
      for ($i = 0, $size = count($giornataX); $i < $size; ++$i){
        $match = $giornataX[$i];
        echo  "<li>".$match->homeTeam ." - " .$match->visitorTeam ." | " .$match->homePoits ." - ". $match->visitorPoits ."</li>";
      }
    ?>  
  </ul>
</body>
</html>

<!-- PHP Snack 2:
Passare come parametri GET name, mail e age e
verificare (cercando i metodi che non
conosciamo nella documentazione) che:
1. name sia più lungo di 3 caratteri,
2. mail contenga un punto e una chiocciola
3. age sia un numero.
Se tutto è ok stampare “Accesso riuscito”, altrimenti
“Accesso negato” -->

<!-- //Soluzione 1 -->

<?php
  $name=$_GET["name"];
  $age=$_GET["age"];
  $email=$_GET["email"];
  $access = "";

    if (empty($name) || empty($email) || empty($age)) {
      $access = "<h3>Compila correttamente - Ricorda:</h3> <ul> <li> Il nome deve avere più di 3 caratteri;</li> <li>la mail deve contenere un punto (.) e una @</li> <li>la tua età si spera venga espressa in cifre e non in lettere 🤠</li>";
    } elseif ((strlen($name) < 3) || (strpos($email, ".") === false || strpos($email, "@") === false) || (!is_numeric($age)) ) {
      $access = "Accesso negato";
    } else {
      $access = "Accesso riuscito";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Snack</title>
</head>
<body>
    <h1> Snack 2 - Validatore Form PHP - Soluzione 1</h1>
    <form action="" method="get">
      <label for="name">Inserisci il tuo nome:</label>
      <input type="text" name="name" id="name" placeholder="Inserisci nome"> <br> <br>
      <label for="age">Inserisci la tua età:</label>
      <input type="text" name="age" id="age" placeholder="Inserisci età"> <br> <br>
      <label for="age">Inserisci la tua email:</label> 
      <input type="text" name="email" id="email" placeholder="Inserisci email"> <br> <br>
      <input type="submit" value="Aprimi">    
    </form>
    <h2>
      <?php echo $access;?>
    </h2>
  </ul>
</body>
</html>
