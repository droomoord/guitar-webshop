<?php include 'partials/head.php'; ?>
   
    
    <h1>Contact</h1>

    <form id=contact-form method="post" action="form_post.php">
        <label> Name:
            <input name="name" type="text">
        </label>
        <label> Email:
            <input name="email" type="text">
        </label>
            <div id="message">
                <label for="message">Message:</label>
                <textarea name="message" id="message" cols="30" rows="10"></textarea>
            </div>
       
        <input type="submit" value="Send">
    </form>

    <?php include 'partials/footer.php'; ?>