document.addEventListener('DOMContentLoaded', function () {
    const cardContainer = document.getElementById('card-container');
    fetch('like-chat.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const card = document.createElement('div');
                card.classList.add('card');
                card.innerHTML = `
                    <div class="card-img">
                        <img src="uploads/${item.image_path}" alt="${item.user_name}">
                    </div>
                    <p>${item.user_name}</p>
                    </div>
                `;
                
                 // เพิ่มอีเวนท์ click ที่ card
                card.addEventListener('click', function () {
                    // ทำสิ่งที่คุณต้องการเมื่อคลิกที่ card
                    console.log(`Clicked on card for user: ${item.user_name}`);
                    fetch('like-select-chat.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ user_name: item.user_name })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // ทำสิ่งที่คุณต้องการหลังจากการส่งข้อมูล
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
                cardContainer.appendChild(card);
            });
        })
        .catch(error => console.error('Error:', error));
});

document.addEventListener('DOMContentLoaded', function () {
    const cardContainer = document.getElementById('card-container');
    let isMouseDown = false;
    let startX, scrollLeft;

    cardContainer.addEventListener('mousedown', function (e) {
        isMouseDown = true;
        startX = e.pageX - cardContainer.offsetLeft;
        scrollLeft = cardContainer.scrollLeft;
    });

    cardContainer.addEventListener('mouseleave', function () {
        isMouseDown = false;
    });

    cardContainer.addEventListener('mouseup', function () {
        isMouseDown = false;
    });

    cardContainer.addEventListener('mousemove', function (e) {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - cardContainer.offsetLeft;
        const walk = (x - startX) * 3; // ความเร็วในการเลื่อน
        cardContainer.scrollLeft = scrollLeft - walk;
    });

    // ... โค้ดอื่น ๆ ที่คุณมี

});

document.addEventListener('DOMContentLoaded', function () {
    const cardContainer = document.getElementById('card-container-side');
    fetch('like-chat.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const card = document.createElement('div');
                card.classList.add('card');
                card.innerHTML = `
                    <div class="card-img">
                        <img src="uploads/${item.image_path}" alt="${item.user_name}">
                    </div>
                    <p class="name-user">${item.user_name}</p>
                    </div>
                `;
                cardContainer.appendChild(card);
            });
        })
        .catch(error => console.error('Error:', error));
});


document.addEventListener('DOMContentLoaded', function () {
    const cardContainer = document.getElementById('card-container-side');
    let isMouseDown = false;
    let startY, scrollTop;

    cardContainer.addEventListener('mousedown', function (e) {
        isMouseDown = true;
        startY = e.pageY - cardContainer.offsetTop;
        scrollTop = cardContainer.scrollTop;
    });

    cardContainer.addEventListener('mouseleave', function () {
        isMouseDown = false;
    });

    cardContainer.addEventListener('mouseup', function () {
        isMouseDown = false;
    });

    cardContainer.addEventListener('mousemove', function (e) {
        if (!isMouseDown) return;
        e.preventDefault();
        const y = e.pageY - cardContainer.offsetTop;
        const walk = (y - startY) * 3; // ความเร็วในการเลื่อน
        cardContainer.scrollTop = scrollTop - walk;
    });

    // ... โค้ดอื่น ๆ ที่คุณมี

});


