// ดึงข้อมูลจาก PHP
fetch('information-card.php')
.then(response => response.json())
.then(data => {
    // สร้าง HTML สำหรับแสดงการ์ด
    const userCardsContainer = document.getElementById('user-cards');
    data.forEach(userData => {
        const cardElement = document.createElement('div');
        cardElement.classList.add('card');

        const imageElement = document.createElement('img');
        imageElement.src = 'uploads/' + userData.image_path; // เพิ่ม 'uploads/' ไปที่ userData.image_path
        imageElement.alt = 'User Image';

        const nameElement = document.createElement('p');
        nameElement.textContent = userData.user_name;

        cardElement.appendChild(imageElement);
        cardElement.appendChild(nameElement);

        userCardsContainer.appendChild(cardElement);
    });
})
.catch(error => console.error('Error fetching data:', error));