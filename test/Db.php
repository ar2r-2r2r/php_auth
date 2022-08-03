<?php
class Db{
    private $jsonArray;

    public function __construct()
    {
    }

    //CRUD

    function create(){                                                      //create
        $json = fopen("dba.json", "w");
    }

    function read(){                                                        //read
        $json = file_get_contents('db.json');
        $this->jsonArray = json_decode($json, true);
        return $this->jsonArray;
    }

    function update($user){                                            //update
        $json = file_get_contents('db.json');
        $jsonArray = json_decode($json, true);  //старые значения
        $jsonArray[] = $user->getData();
        file_put_contents('db.json', json_encode($jsonArray));
    }

    function delete($data)                                          //delete
    {
        $login =trim($data['login']);
        $flag=0;
        foreach ($this->jsonArray as $item) {
            if (strtolower($item['login']) === strtolower($login)) {
                unset($item);
                $flag=1;
            }
        }
        if ($flag==1){
            file_put_contents('db.json', json_encode($this->jsonArray));
        }
        else{
            echo 'Такого логина для удаления не нашлось';
        }
    }



}