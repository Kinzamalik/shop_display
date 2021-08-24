<?php

// inclue config file

require_once "config.php";


// Define variables and initialize with empty values
$title = $description = $content = $slug ="";
$title_err = $description_err = $content_err =  $slug_err="";

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter Categoty title.";
    } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid Category.";
    } else{
        $title = $input_title;
    }

    //  Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter Category Description.";     
    } else{
        $description = $input_description;
    }

       //  Validate content
       $input_content = trim($_POST["description"]);
       if(empty($input_content)){
           $content_err = "Please enter Category Content.";     
       } else{
           $content = $input_content;
       }


           //  Validate slug
           $input_slug = trim($_POST["slug"]);
           if(empty($input_slug)){
               $slug_err = "Please enter Category Slug.";     
           } else{
               $content = $input_slug;
           }

           
    // Check input errors before inserting in database
    if(empty($title_err) && empty($description_err) && empty($context_err) && empty($slug)){
        // Prepare an insert statement
        $sql = "INSERT INTO categories (title, description, content,slug) VALUES (?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_title, $param_description, $param_content, $param_slug);
            
            // Set parameters
            $param_title = $title;
            $param_description = $description;
            $param_content = $content;
            $param_slug =$slug;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>


 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Category</h2>
                    <p>Please fill this form and submit to add category records to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            <input type="text" name="content" class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $content; ?>">
                            <span class="invalid-feedback"><?php echo $content_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control <?php echo (!empty($slug_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $slug; ?>">
                            <span class="invalid-feedback"><?php echo $slug_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

   


}
?>