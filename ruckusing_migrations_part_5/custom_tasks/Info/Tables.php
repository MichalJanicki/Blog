<?php

class Task_Info_Tables extends Ruckusing_Task_Base implements Ruckusing_Task_Interface {

    public function __construct($adapter)
    {
        parent::__construct($adapter);
        $this->_adapter = $adapter;
    }

    public function execute($args){
        $result = $this->_adapter->query("SELECT table_name AS tn
            FROM information_schema.tables
            WHERE table_schema = DATABASE();");

        $output =  "|---------------------------------| \n";

        if (count($result)) {
            $i = 1;
            foreach ($result as $key => $value) {
                $output .=  ' ' . $i . ". \t" . $result[$key]['tn'] ."\n";
                $output .=  "|---------------------------------| \n";
                $i++;
            }
        } else {
            $output .= "\t Brak tabel w bazie \n";
            $output .= "|---------------------------------| \n";
        }

        echo $output;
    }

    public function help(){
        return "\n \t Przykładowe zadanie wyświetlające listę tabel w bazie danych \n";
    }

}
