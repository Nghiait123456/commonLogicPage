<?php
 $logicInput =[ 'logic1'=> [ 'detail'=>"I1", 'valueRealtime'=>true ],
                'logic2'=>['detail'=>"I2", 'valueRealtime'=>true ],
                'logic3'=>['detail'=>"I3", 'valueRealtime'=>false ],
                'logic4'=>[ 'detail'=>"I4", 'valueRealtime'=>true ],
                'logic5'=>[ 'detail'=>"I5", 'valueRealtime'=>true ],
];
 $valueOp1 = (  ($logicInput['logic1']['valueRaltime']) && ( ($logicInput['logic2']['valueRaltime']) || (!$logicInput['logic3']['valueRaltime']) )   ) ;
 $valueOp2 = (  ($logicInput['logic4']['valueRaltime']) && ( ($logicInput['logic1']['valueRaltime']) || (!$logicInput['logic2']['valueRaltime']) )   ) ;
$valueOp3 = (  ($logicInput['logic3']['valueRaltime']) && ( ($logicInput['logic5']['valueRaltime']) || (!$logicInput['logic6']['valueRaltime']) )   ) ;
$logicOutput =['logic1'=>['code'=>"O1", 'proiority'=>2, 'valueRealtime'=>$valueOp1],
               'logic2'=>['code'=>"O2", 'proiority'=>1,  'valueRealtime'=> $valueOp2],
              'logic3'=>['code'=>"O1", 'proiority'=>2, 'valueRealtime'=>$valueOp3]
              ];
$test =[is_string(),is_array()];
var_dump($test);

class CommonLogicPage
{
//logic input : I1,I2,I3,I4,...
//case output : O1,O2,O3,...
//độ ưu tiên : T1,T2,T3,....
//
//
//I1,I2,I3 ,,, { name=>"", code=>"", value=>{ true,false } }
//
//O1,O2,O3 ,,, { name=>"",code=>"", priority=>interger,  value=>{true,false } }
protected $_inputs = [];
private $_maxProperty;
private $_maxKeyRoot;
private $_outputKey=[];

public function __construct( )
{
    $this->resetProperty();
}



// call in contruct and before start other process withow new object
public function  resetProperty(){
    $this->_inputs = [];
    $this->_maxProperty = null;
    $this->_maxKeyRoot = null;
    $this->_outputKey=[];
}
public  function setInput(array  $inputs){
    if(empty($inputs)){
        throw new \Exception('Please pass Input array data');
    }
    $this->_inputs[]=$inputs;
    return $this;
}

public  function  startProcess(){
    $this->validateDataInput($this->_inputs);
    $this->findMaxProperty();
    return $this;
}

const  listKey = ['code','proiority','valueRealtime'];



public function grapKey( array $inputs, string $keygrab ){
    $output = [$keygrab=>[], 'mapKeyGrabwithRootkey'=>[]];
    foreach ($inputs as $key=>$value){
        $output[$keygrab] += $value[$keygrab];
        $output['mapRootkeywithKeyGrab'] +=  [$value[$keygrab]=>$key];
    }
    $this->_outputKey = $output;
    return $this;
}

public function findMaxProperty( array $input ){
    $min =  min($input);
    $this->_maxProperty = $min;
    $this->_maxKeyRoot = $this->_outputKey['mapRootkeywithKeyGrab'][$min];
    return $this;
}


protected function parserInput(array $inputs, string $keygrab){
   $this->grapKey($inputs,'proiority');
   $this->findMaxProperty($this->_outputKey[$keygrab]);
   return $this;
}

public function getKeyResult(){
    if(empty($this->_maxKeyRoot)){
        throw new \Exception('Please perform exactly process : mising Input data');
    }
    return $_maxKeyRoot
}

public function getPropertyResult(){
        if(empty($this->_maxProperty)){
            throw new \Exception('Please perform exactly process : mising Input data');
        }
        return $this->_maxProperty;
}

public function validateDataInput(array $inputs)
{
    foreach ($inputs as $key => $value) {
        // check missing key,value
        $this->checkMissingKey(self::listKey,$value);
        // check type
        if(  (!is_string($value['code']))  ||  (!is_int($value['proiority']))  ||  (!is_string($value['defineName']))  ){
                throw new \Exception('type of varible of '.$key.' incorrect');
                }
    };
}


protected function checkMissingKey(array $listKeys, array $arrayCheck){
   foreach ($listKeys as $listKey){
       if(!array_key_exists($listKey,$arrayCheck)){
           throw new \Exception('missing  '.$listKey.' in List key of Array Output');
       }
   }
}

p

protected function parserInput(array $inputs){
    foreach ($inputs as $input){

    }
}

//  loc voi do uu tien
// tra ve cả mang, hoac tra ve funtion co do uu tien cao nhat


}