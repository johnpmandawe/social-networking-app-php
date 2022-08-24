<?php 
$enc_array = ['a' => '$^7d',
              'b' => '*()j',
              'c' => '&^hG',
              'd' => '^&hs',
              'e' => '0987',
              'f' => 'jgys',
              'g' => 'dasd',
              'h' => '&^%H',
              'i' => '$%%D',
              'j' => 'GHVF',
              'k' => 'bc^&',
              'l' => 'mnas',
              'm' => '!@##',
              'n' => '%lpp',
              'o' => '$$v&',
              'p' => 'ASDV',
              'q' => '%^&&',
              'r' => 'AaVV',
              's' => 'Ll13',
              't' => 'LKJH',
              'u' => '666$',
              'v' => '(((6',
              'w' => '#$KL',
              'x' => 'ZXC$',
              'y' => 'XxXY',
              'z' => 'asas',
              '1' => '0688',
              '2' => '2342',
              '3' => '0978',
              '4' => '3452',
              '5' => 'bgty',
              '6' => 'cvcv',
              '7' => 'khjk',
              '8' => 'qwer',
              '9' => '3576',
              '0' => '0000',
              ' ' => 'nhg$'];

// $string = 'mandawe1023';
// $enc = '';
// $dec = '';
// $counter = 0;
// for ($i=0; $i < strlen($string); $i++) { 
//   $char = $string[$i];
//   foreach ($enc_array as $key => $val) {
//     if ($key == $char) {
//       $enc .= $val;
//     }
//   }
// }
// $enc_len = floor(strlen($enc)/4);
// for ($i=0; $i < $enc_len; $i++) {
//   $chars = substr($enc, $counter, 4);
//   echo $chars.'</br>';
//   $counter += 4;
//   foreach ($enc_array as $key => $val) {
//     if ($val == $chars) {
//       $dec .= $key;
//     }
//   }
// }

// echo $enc.'</br>';
// echo $enc_len.'</br>';
// echo $dec.'</br>';
// echo $counter;

// echo json_encode($enc_array);
echo $_POST['data'];
echo 'hello';

?>