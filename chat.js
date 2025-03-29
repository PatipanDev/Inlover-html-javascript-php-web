function sendMessage() {
    var messageInput = document.getElementById('message-input');
    var message = messageInput.value;

    // Simulate sending the message to the server (you need to replace this with actual AJAX/fetch)
    var newMessage = document.createElement('div');
    newMessage.className = 'message';
    newMessage.textContent = message;
    
    document.getElementById('chat-messages').appendChild(newMessage);

    // Clear the input field
    messageInput.value = '';
}
