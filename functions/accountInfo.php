<?php
function getContent(){
    if (!file_exists(__DIR__.'/../server/acounts.json')) {
      return  file_put_contents(__DIR__.'/../server/acounts.json', json_encode([]));
    }
    $duomenys = file_get_contents(__DIR__.'/../server/acounts.json');
    return json_decode($duomenys, 1);
}

function clientId(){
    if (!file_exists(__DIR__.'/../server/client.json')) {
        return  file_put_contents(__DIR__.'/../server/client.json', json_encode(['id'=> 1]));
      }
    $uniqClientId = json_decode(file_get_contents(__DIR__.'/../server/client.json'), 1);
    $uniqClientId['id'] += 1;
    file_put_contents(__DIR__.'/../server/client.json', json_encode($uniqClientId));
    return $uniqClientId['id'];
}

function creatAcount($sasNr, $vardas, $pavarde, $asmKodas){
    
    $allAcounts = getContent();
    $klientas = clientId();
    $acount = ['client' => $klientas, 'sasNr' => $sasNr, 'name' => $vardas, 'surname' => $pavarde, 'personId' => $asmKodas, 'suma' => 0];
    $allAcounts[]=$acount;
    usort($allAcounts, function($x, $y) {
      return $x['surname'] <=> $y['surname'];
  });
    file_put_contents(__DIR__.'/../server/acounts.json', json_encode($allAcounts));
}

function addMoney($id, $sum){
  $acount = getContent();
  foreach(getContent() as $key => $duomenys) { 
    if ($duomenys['client'] == $id) {
      $acount[$key]['suma'] += $sum;
      
    }
  }file_put_contents(__DIR__.'/../server/acounts.json', json_encode($acount));
}

function outMoney($idd, $suma){
  $acountMinus = getContent();
  foreach(getContent() as $key => $duomenys) { 
    if ($duomenys['client'] == $idd) {
      $acountMinus[$key]['suma'] = $acountMinus[$key]['suma'] - $suma;
      
    }
  }file_put_contents(__DIR__.'/../server/acounts.json', json_encode($acountMinus));
}

function deleteAccount($idd){
  $acountToDelete = getContent();
  foreach(getContent() as $key => $duomenys) { 
    if ($duomenys['client'] == $idd ) {
      unset($acountToDelete[$key]);
      file_put_contents(__DIR__.'/../server/acounts.json', json_encode($acountToDelete));
    }
  }
}

?>