<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sohbet</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body data-user-id="{{ auth()->user()->id }}">
    <div class="flex h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
                <div class="flex flex-row items-center justify-center h-12 w-full">
                    <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <div class="ml-2 font-bold text-2xl">Sohbet</div>
                </div>

                <div class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-2 px-4 rounded-lg">
                    <div class="text-sm font-semibold" id="userName">{{ auth()?->user()?->name }}</div>
                </div>

                <div class="flex flex-col mt-8">
                    <div class="flex flex-row items-center justify-between text-xs">
                        <span class="font-bold">Katılımcılar</span>
                    </div>
                    <div class="flex flex-col space-y-1 mt-4 -mx-2 overflow-y-auto" id="userList">


                    </div>
                </div>
            </div>
            <div class="flex flex-col flex-auto h-full p-6">
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <div class="flex flex-col h-full overflow-x-auto mb-4" id="messagesContainer">
                        <div class="flex flex-col h-full">
                            <div class="grid grid-cols-12 gap-y-2" id="messages">
                            </div>
                        </div>
                    </div>
                    <form id="messageForm" class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4 relative">
                        <div id="typingArea" class="absolute -top-6 text-sm font-medium"></div>
                        <div class="flex-grow">
                            <div class="relative w-full">
                                <input id="messageInput" type="text" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" placeholder="Mesajınızı yazın" autocomplete="off" />
                            </div>
                        </div>
                        <div class="ml-4">
                            <button class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                <span>Gönder</span>
                                <span class="ml-2">
                                    <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userId = parseInt(document.querySelector('body').getAttribute('data-user-id'));
        const typingArea = document.getElementById('typingArea');
        let userList = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Mesajları dinle
            /*
            Echo.channel(`chat`) // kanal adı
                .listen('SendMessage', (e) => { // event adı
                    
                });
            */

            Echo.join('chat') // kanal adı
                .listen('SendMessage', (e) => { // dinlenecek event adı
                    getMessage(e);
                })
                .here((users) => {
                    userList = users;
                    refreshUsers();
                })
                .joining((user) => {
                    console.log(user.name + ' katıldı');
                    userList.push(user);
                    refreshUsers();
                })
                .leaving((user) => {
                    console.log(user.name + ' ayrıldı');
                    userList = userList.filter(u => u.id !== user.id);
                    refreshUsers();
                })
                .error((error) => {
                    console.error(error);
                });


            Echo.private('chat')
                .listenForWhisper('typing', (response) => {
                    const typingText = response.userName + ' yazıyor...';

                    typingArea.innerHTML = typingText;

                    setTimeout(() => {
                        typingArea.innerHTML = '';
                    }, 1000);
                });

            document.getElementById('messageInput').addEventListener('keyup', function() {
                const userName = document.getElementById('userName').textContent;
                Echo.private('chat')
                    .whisper('typing', {
                        userName: userName,
                    });
            });
        });

        // Mesaj gönderme
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();
            sendMessage();
        });

        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value;
            messageInput.value = '';

            fetch(`/send-message`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: message
                })
            }).catch(error => console.error('Hata:', error));
        }

        function getMessage(e) {
            const messages = document.getElementById('messages');
            const messageElement = document.createElement('div');
            const messagesContainer = document.getElementById('messagesContainer');

            if (e.id === userId) { // Kendi mesajım
                messageElement.classList.add('col-start-6', 'col-end-13', 'p-3', 'rounded-lg');
                messageElement.innerHTML = `<div class="flex items-center justify-start flex-row-reverse">
                                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0 text-white" title="${e.userName}">
                                                            ${e.userName.charAt(0) ?? 'X'}
                                                        </div>
                                                        <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                                            <div>${e.message}</div>
                                                        </div>
                                                    </div>`;
            } else { // Karşıdan gelen mesaj
                messageElement.classList.add('col-start-1', 'col-end-8', 'p-3', 'rounded-lg');
                messageElement.innerHTML = `<div class="flex flex-row items-center">
                                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-red-500 flex-shrink-0 text-white" title="${e.userName}">
                                                            ${e.userName.charAt(0) ?? 'X'}
                                                        </div>
                                                        <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                            <div>${e.message}</div>
                                                        </div>
                                                    </div>`;
            }

            messages.appendChild(messageElement);
            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Mesaj penceresini sona kaydır
        }

        function refreshUsers() {
            listArea = document.getElementById('userList');
            listArea.innerHTML = '';

            userList.forEach(user => {
                const userElement = document.createElement('button');
                userElement.classList.add('flex', 'flex-row', 'items-center', 'hover:bg-gray-100', 'rounded-xl', 'p-2');
                userElement.innerHTML = `<div class="flex items-center justify-center h-8 w-8 ${user.id === userId ? 'bg-indigo-500' : 'bg-red-500'} rounded-full text-white">
                                            ${user.name.charAt(0) ?? 'X'}
                                        </div>
                                        <div class="ml-2 text-sm font-semibold">${user.name}</div>`;
                listArea.appendChild(userElement);
            });

        }
    </script>
</body>

</html>
