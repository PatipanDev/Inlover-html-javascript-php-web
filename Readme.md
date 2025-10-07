
#  inlover — เว็บหาคู่ (HTML, CSS, JavaScript, PHP, MySQL)

เว็บแอพพลิเคชัน “inlover” ซึ่งเป็นเว็บไซต์ที่มีแรงบันดาลใจมาจาก แอปพลิเคชันหาคู่ หรือ แอปฯ หาคู่ พัฒนาด้วยภาษา HTML, CSS, JavaScript, PHP และใช้ ระบบจัดการฐานข้อมูล MySQL หรือ ฐานข้อมูล MySQL. 2566.

---

##  คุณสมบัติ (Features)
- ✅ สมัครสมาชิก / เข้าสู่ระบบ (Register / Login)
- 👤 โปรไฟล์ผู้ใช้ (Profile)
- 💖 กดถูกใจ (Like) และระบบจับคู่ (Match)
- 💬 ระบบแชทพื้นฐาน (Basic Chat)
- 📷 อัปโหลดรูปโปรไฟล์ (Profile Image Upload)
- 🔎 ค้นหาผู้ใช้ (Filter by gender / age)

---

## 🧩 เทคโนโลยีที่ใช้ (Tech Stack)
**Frontend:**  
- HTML5  
- CSS3  
- JavaScript (Vanilla)

**Backend:**  
- PHP (Plain PHP / PDO)
- MySQL Database

**Dev Tools:**  
- XAMPP 
- phpMyAdmin  

---

## 📁 โครงสร้างโปรเจกต์ (Project Structure)

inlover/  
├── chat/  
├── icon/  
├── sounds/  
├── uploads/  
├── uploads_post/  



## วิธีการติดตั้ง 

    git clone https://github.com/PatipanDev/Inlover-html-javascript-php-web
    cd Inlover-html-javascript-php-web


### 3. นำไฟล์ไปไว้ในโฟลเดอร์ `htdocs`

ตัวอย่าง:  
`C:\xampp\htdocs\inlover`

### 4. สร้างฐานข้อมูล

เข้า phpMyAdmin → สร้างฐานข้อมูลชื่อ `inlover_db`  
จากนั้นนำเข้าไฟล์ `database/schema.sql`

### 5. ตั้งค่าการเชื่อมต่อฐานข้อมูล

เปิดไฟล์ `config.php` แล้วแก้ไขข้อมูลให้ตรงกับเครื่องคุณ

### 6. เริ่มใช้งาน

เปิดเบราว์เซอร์และเข้าไปที่  
👉 [http://localhost/[PORT]](http://localhost/inlover)