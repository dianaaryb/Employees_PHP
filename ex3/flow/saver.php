 <?php

$message = $_POST['message'] ?? '';

saveMessage($message);

include 'thanks.html'; //trukitakse kasutajale valja, kui poordutakse saver.php poole

//header('Location: thanks.html');//see script tegi tood ja utles brauserile, et mine jargmisele aadressile

function saveMessage(string $message): void {
    // Some code to saves the message
    // This is not important in this context.
}


