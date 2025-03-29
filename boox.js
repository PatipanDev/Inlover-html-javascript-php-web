function showPopup() {
    // document.getElementById('popupMessage').innerText = message;
    let containerDiv = document.createElement('div');
    containerDiv.classList.add('card-container-like');
    
    const card_me = document.createElement('div');
    card_me.classList.add('card-show-match');
    card_me.innerHTML = `
        <div class="card-img-match">
            <img src="uploads/${item.image_path}" alt="${item.user_name}">
        </div>
        <p class="name-user">${item.user_name}</p>
    `;
    containerDiv.appendChild(card_me);
    cardContainer.appendChild(containerDiv);

    fetch('match-img-myself.php')
        .then(response => response.json())
        .then(data1 => {
            data1.forEach(item1 => {
                const card_like = document.createElement('div');
                card_like.classList.add('card-show-match');
                card_like.innerHTML = `
                    <div class="card-img-match">
                        <img src="uploads/${item1.image_path}" alt="${item1.user_name}">
                    </div>
                    <p>${item1.user_name}</p>
                `;
                containerDiv.appendChild(card_like);
                cardContainer.appendChild(containerDiv);
                // Append the created card to the DOM or perform any other necessary actions
            });
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        });

    cardContainer.appendChild(containerDiv);
    setTimeout(() => {
            containerDiv.remove();
        }, 5000); //3000 มีแสดงถึง 5 วินาที
}

// ฟังก์ชันเพื่อดึงข้อมูลจาก MySQL และแสดง Popup ครั้งแรก
function fetchDataAndShowPopup() {
    // ทำการเรียก Fetch API หรือ AJAX เพื่อดึงข้อมูลจาก PHP
    fetch('match-like-show.php')
        .then(response => response.json())
        .then(data1 => {
            // ตรวจสอบว่ามีข้อมูลหรือไม่
            if (data1.length > 0) {
                // แสดง Popup พร้อมข้อมูลที่ดึงมา
                console.log('มีข้อมูล');
                showPopup();
                // บันทึกข้อมูลการแมท
                fetch('match-like-save.php')
                    .then(response => response.json())
                    .then(data2 => {
                        // ตรวจสอบว่ามีข้อมูลหรือไม่
                        if (data2.length > 0) {
                            // แสดง Popup พร้อมข้อมูลที่ดึงมา
                            console.log('มีข้อมูล');
                            // console.log('มีข้อมูล');
                        } else {
                            // ถ้าไม่มีข้อมูล
                            console.log('ไม่พบข้อมูล');
                        }
                    })
                    .catch(error => {
                        console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
                    });
                // console.log('มีข้อมูล');
            } else {
                // ถ้าไม่มีข้อมูล
                // showPopup('ไม่พบข้อมูล');
                console.log('ไม่พบข้อมูล');
            }
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        });
}
fetchDataAndShowPopup();