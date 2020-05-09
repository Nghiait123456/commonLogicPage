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
$logicOutput =[ ['code'=>"O1", 'priority'=>1, 'name'=>'logic1','valueRealtime'=>$valueOp1],
                ['code'=>"O2", 'priority'=>2, 'name'=>'logic2', 'valueRealtime'=> $valueOp2],
                ['code'=>"O1", 'priority'=>3,'name'=>'logic3', 'valueRealtime'=>$valueOp3]
              ];
$test =[is_string(),is_array()];
var_dump($test);
//$a = new CommonLogicPage();
//$a->setInput($logicOutput)->startProcess();
//$a->getListHasMaxPriority();
//$a->getNameFromMaxPriority();
//....
////if continue set input without new(), used ressetProperty
//$a->resetProperty();



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
protected $_listPriority= [];
private $_maxProperty;
private $_maxKeyRoot;
private $caseMaxProiority =[];
const  listKey = ['code','proiority','valueRealtime'];
public function __construct( )
{
    $this->resetProperty();
}



// call in contruct and before start other process withow new object
public function  resetProperty(){
     $this->_inputs = [];
     $this->_listPriority= [];
     $this->_maxProperty = null;
     $this->_maxKeyRoot = null;
    $caseMaxProiority =[];
}
public  function setInput(array  $inputs){
    if(empty($inputs)){
        throw new \Exception('Please pass Input array data');
    }
    $this->_inputs[]=$inputs;
    return $this;
}

public  function  startProcess() {
    $this->validateDataInput($this->_inputs);
    $this->parserInput( $this->_inputs, 'proiority');
    $this->setListHasMaxPriority();
    return $this;
}





public function filterKey( array $inputs, string $keyFitler ){
    $listsProperty = [];
    foreach ($inputs as $key=>$value){
        if($value['valueRealtime']){
            $listsProperty[]= $value['priority'];
        }
    }
    $this->_listPriority = $listsProperty;
    return $this;
}

public function findMaxProperty( array $listValue ){
    $min =  min($listValue);
    $this->_maxProperty = $min;
    return $this;
}

public function  setListHasMaxPriority(){
  if(  empty($this->_listPriority) && empty($this->_maxProperty) ){
      throw new \Exception('Please perform exactly process ');
  }
  foreach ($this->_inputs as $key=>$value){
      if($value['priority'] === $this->_maxProperty ){
          $this->caseMaxProiority  = [$key=>$value];
          return $this;
      }
  }
}


public function getListHasMaxPriority(){
    if(  empty($this->caseMaxProiority )  ){
        throw new \Exception('Please perform exactly process ');
    }
    return $this->caseMaxProiority;
}

public function getNameFromMaxPriority(){
    if(  empty($this->caseMaxProiority )  ){
        throw new \Exception('Please perform exactly process ');
    }
    return $this->caseMaxProiority['name'];
}




protected function parserInput(array $inputs, string $keyFitler){
   $this->filterKey($inputs,$keyFitler);
   $this->findMaxProperty($this->_listPriority);
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
        // check type and check not null
        if(  (!is_string($value['code']))  ||  (!is_int($value['priority']))  ||  (!is_bool($value['valueRealtime']))  ){
                throw new \Exception('type or value of varible of '.$key.' incorrect');
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