<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="webprogstyle.css">
    <title>WEB PROG PROFILE</title>
</head>
<body>

    <header>
        <div class="profile-picture"></div>
        <h1>Joris O. Aguarin</h1>
    </header>

    <section class="about">
        <h2>About Me</h2>
        <p>Hello! I'm Joris O. Aguarin and i'm 21 years old. As an individual, I am a curious and driven person with a deep passion for continuous learning and self-improvement. I thrive on challenges and approach each new opportunity with enthusiasm and an open mind. With a diverse set of interests, I find joy in exploring various facets of life, from technology and literature to art and science. My adaptability allows me to navigate through different environments and connect with people from various walks of life. I believe in the power of empathy and effective communication, recognizing the importance of understanding others' perspectives. Whether it's tackling a complex problem or embracing a new hobby, I approach each endeavor with dedication and a positive mindset. Striving for balance in all aspects of life, I value personal growth, meaningful connections, and making a positive impact on the world around me.</p>
    </section>

    <section class="contact">
        <h2>Contact Information</h2>
        <p>Email: aguarinjo@students.nu-fairview.edu.ph</p>
        <p>Phone: 09092349888</p>
    </section>

    <section class="social">
        <h2>Social Media</h2>
        <ul class="social-links">
            <li><a href="https://www.facebook.com/jorisaguarin16/" target="_blank">Facebook</a></li>
            <li><a href="https://www.instagram.com/_risxcs/" target="_blank">Instagram</a></li>
            <li><a href="https://twitter.com/Risicels" target="_blank">Twitter</a></li>
            <li><a href="https://www.linkedin.com/in/joris-aguarin-0117b4288/" target="_blank">linkeIn</a></li>
            
        </ul>
    </section>

    <section class="skills">
        <h2>Skills</h2>
        <ul>
            <li>HTML</li>
            <li>CSS</li>
            <li>Python</li>
            <li>Simple Web Design</li>
            
        </ul>
    </section>

    <div id="comment-section">
    <h2>Leave a comment for me to be better in designing and coding :> </h2>
    <form action="comment.php" method="POST" onsubmit="return showAlert()">
        <label for="commenter_name">Your Name:</label><br>
        <input type="text" id="commenter_name" name="commenter_name" required><br>
        <label for="comment_text">Comment:</label><br>
        <textarea id="comment_text" name="comment_text" rows="4" required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</div>

<script>
    function showAlert() {
        alert("Thank you for your comment!");
        return true; // return true to allow the form submission, false to prevent it
    }
</script>
>
    
    <button onclick="logout()">Logout</button>

    <script>
        function logout() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "logout.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    window.location.href = "login.php";
                }
            };
            xhr.send();
        }
    </script>


</body>
</html>
