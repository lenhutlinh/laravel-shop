<script>
    var isUserMessage = data.sender == 2;

// Get the appropriate container based on the sender
var container = isUserMessage ? document.getElementById('chat_message') : document.getElementById('message_right');

// Create a new message div
var newMessage = document.createElement('div');
newMessage.className = isUserMessage ? 'chat-message-right pb-4' : 'chat-message-left pb-4';

// Build the HTML for the message
var messageHTML = '<div><img src="' + (isUserMessage ? '{{asset('storage/'.$user_img)}}' : '{{asset('storage/'.$shop_chat->shopImg)}}') + '" class="rounded-circle mr-1" alt="' + (isUserMessage ? 'Chris Wood' : 'Sharon Lessman') + '" width="40" height="40">';
messageHTML += '<div class="text-muted small text-nowrap mt-2">' + data.timestamp + '</div></div>';
messageHTML += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 ' + (isUserMessage ? 'mr-3' : 'ml-3') + '"><div class="font-weight-bold mb-1">' + (isUserMessage ? 'You' : $shop_chat->shopname) + '</div>' + data.message + '</div>';

// Set the inner HTML of the new message div
newMessage.innerHTML = messageHTML;

// Append the new message to the appropriate container
container.appendChild(newMessage);

// If this is a real-time user message, also scroll to the bottom
if (isUserMessage) {
    container.scrollTop = container.scrollHeight;
}

// If this is a real-time message, show the real-time container
if (!isUserMessage) {
    document.getElementById('message_right').style.display = 'block';
}
</script>