<?php

require_once '../connection.php';
require_once 'MenuItem.php';

printMenu(getMenu());
function getMenu(): array {

    $conn = getConnection();

    $stmt = $conn->prepare('SELECT id, parent_id, name 
                            FROM menu_item ORDER BY id');

    $stmt->execute();

    $dict = [];
    $menu = [];
    foreach ($stmt as $row) {
        $id = $row['id'];
        $name = $row['name'];
        $parentId = $row['parent_id'];

        $newItem = new MenuItem($id, $name);
        $dict[$id] = $newItem;
//        print_r($dict);

        if($parentId != null){
            $dict[$parentId]->addSubItem($newItem);
        }else{
            $menu[] = $newItem;
        }
    }
    return $menu;

//  For each row retrieved, a new MenuItem object is created with id and name.
//  The new MenuItem is stored in a $dict array using id as the key.
//  If the parent_id is not null, the current item is added as a sub-item to the corresponding parent item in the $dict array.
//  If parent_id is null, it's a top-level menu item, and the new MenuItem is added to the $menu array.
}


function printMenu($items, $level = 0) : void {
    $padding = str_repeat(' ', $level * 3);
    foreach ($items as $item) {
        printf("%s%s\n", $padding, $item->name);
        if ($item->subItems) {
            printMenu($item->subItems, $level + 1);
        }
    }
}
