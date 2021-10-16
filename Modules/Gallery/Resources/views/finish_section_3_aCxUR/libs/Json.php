<?php
class Json{

    private $table = '';  
    private $columns = [];

    public function __construct($table, $columns){
        $this->table = $table;
        $this->columns = $columns;
    }

    public function makeID($length = 6){
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);

        $result = substr($arrCharacter, 0, $length);
        return $result;
    }

    public function write($data){
        file_put_contents($this->table, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    public function list(){
        return json_decode(file_get_contents($this->table), true);
    }

    public function get($id){
        $result = null;
        $items = $this->list();
        $index = array_search($id, array_column($items, 'id'));
        if ($index !== false) $result = $items[$index];
        return $result;
    }

    public function delete($id){
        $result = false;
        $items = $this->list();
        $index = array_search($id, array_column($items, 'id'));
        if ($index !== false) {
            $result = $items[$index];
            unset($items[$index]);  
            $items = array_values($items);
            $this->write($items);
        }
        return $result;
    }

    public function add($params = null){
        if ($params != null) {
            $items = $this->list();
            $params = ['id' => $this->makeID()] + $params;
            $item = array_intersect_key($params, array_flip($this->columns));
            $items[] = $item;
            $this->write($items);
            return $item['id'];
        }
    }

    public function update($params = null){
        if ($params != null) {
            $items = $this->list();
            $index = array_search($params['id'], array_column($items, 'id'));
            $item = array_intersect_key($params, array_flip($this->columns));
            $items[$index] = $item;
            $this->write($items);
            return $item;
        }
    }
}
