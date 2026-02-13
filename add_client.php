    <?php include 'header.php'; ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
    <link rel="stylesheet" href="admin_login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Details Form</title>
    </head>

    <body>

    <div class="form-container">
        <h2>Client Details Form</h2>

    <form method="post" action="save_client.php" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name">
                </div>
            </div>

            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company">
            </div>

           <div class="form-group">
                <label>Company Branches</label>
                <div id="branch-wrapper">
                     <div class="branch-row" style="display:flex; gap:8px; margin-bottom:8px;">
                        <input type="text" name="company_branch[]" placeholder="Enter branch name">
                        <button type="button" onclick="addBranch()">+</button>
                     </div>
                </div>
            </div>


            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="phone">
            </div>

            <div class="form-group">
                <label>Street Address</label>
                <input type="text" name="address1">
            </div>

            <div class="form-group">
                <label>Street Address Line 2</label>
                <input type="text" name="address2">
            </div>

            <div class="row">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city">
                </div>
                <div class="form-group">
                    <label>State</label>
                    <input type="text" name="state">
                </div>
                <div class="form-group">
                    <label>Zip Code</label>
                    <input type="text" name="zip">
                </div>
            </div>

            <div class="form-group">
                <label>Company Website</label>
                <input type="url" name="website">
            </div>


            <div class="form-group">
                <label>Priority Of Client</label>
                <input type="text" name="priority">
            </div>

            <div class="form-group">
                <label>Additional Information</label>
                <textarea rows="4" name="info"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function addBranch() {
        const wrapper = document.getElementById('branch-wrapper');

        const div = document.createElement('div');
        div.className = 'branch-row';
        div.style = "display:flex; gap:8px; margin-bottom:8px;";
    
        div.innerHTML = `
            <input type="text" name="company_branch[]" placeholder="Enter branch name">
            <button type="button" onclick="removeBranch(this)">−</button>
        `;
    
        wrapper.appendChild(div);
        }

        function removeBranch(btn) {
     btn.parentElement.remove();
}
</script>

    </body>
    </html>


    <?php include 'footer.php'; ?>
