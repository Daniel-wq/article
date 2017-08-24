<?php

/**
 * 1、验证码类
 * 2、将来很多地方都需要用验证码，如果每次都写一遍太麻烦，太浪费资源，所以可以集成一个类，什么时候用，什么时候调用就可以了。
 * Class Code
 */
class Code{
    //1、声明属性
    //2、为了下面可以方便调用
    private $img;//创建的画布
    private $width;//画布的宽
    private $height;//画布的高
    private $bgColor;//画布的背景色
    private $size;//验证码的字体大小
    private $lengh;//验证码的长度
    private $fontStr;//文字源
    private $string;//字符串

    /**
     * 1、构造方法
     * 2、在实例化开辟一个空间后，就运行此构造函数
     * Code constructor.
     * @param int $width 画布的宽
     * @param int $height 画布的高
     * @param int $size 文字字体大小
     * @param int $lengh 文字长度
     * @param null $bgColor 画布背景颜色
     * @param null $fontStr 字体库
     */
    public function __construct($width=300,$height=80,$size=30,$lengh=5,$bgColor=NULL,$fontStr=NULL){
        //1、定义属性
        //2、首先给各个属性一个默认值，这样如果用户在调用时，不传参数，就使用默认值，如果用户传参数，就用用户的值，使这个类更灵活，方便。
        $this->width = $width;
        $this->height = $height;
        $this->size = $size;
        $this->lengh = $lengh;
        $this->bgColor = is_null($bgColor) ? $color = hexdec('#000000') : $bgColor;
        $this->fontStr = is_null($fontStr) ? 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM' : $fontStr;
    }

    /**
     * 1、显示验证码的方法
     * 2、因为外部需要一个方法来调用显示验证码
     */
    public function show(){
        //1、发送头部
        //标明当前内容是一个图像文件
        header('Content-type:image/png');
        //2、调用创建画布并填充的方法
        $this->createBg();
        //3、调用写字的方法
        $this->write();
        //4、调用干扰的方法
        //制造干扰
        //如果验证码太清晰了那么很容易被机器识别，可能向我们的数据库灌入无用的数据
        $this->makeTrouble();
        //5、调用输出图像，并销毁的方法
        //输出图像，是为了将图像显示出来
        //销毁图像，是为了在运行结束后，将空间资源释放出来，避免占用资源
        $this->showDestory();
    }

    /**
     * 1、创建画布并填充的方法
     * 2、绘画需要环境。所以需要将绘画的环境（即画布创建并填充）
     */
    private function createBg(){
        //1、创建画布
        //2、想要绘画，首先要有可以绘画的地方，所以需要先创建一个画布
        $this->img = imagecreatetruecolor($this->width,$this->height);
        //1、设置画布背景颜色
        //2、创建好画布的宽高后，为了让画板有背景色
        $bgColor = $this->bgColor;
        //1、填充
        //2、将设置好的背景色填充到画板中，完成画板的创建工作
        imagefill($this->img,0,0,$bgColor);
    }

    /**
     * 1、写字的方法
     * 2、这是验证码的内容，我们这里的验证码是文字的，所以这里验证码不能仅仅是图片而已，要告诉用户，需要验证的东西是什么
     */
    private function write(){
        //1、定义一个空字符串变量
        //2、用来接收每次产生的字符，用来写入字符串文件中
        $code='';
        //1、循环
        //2、为了在每次刷新页面，或刷新验证码时，验证码随机改变
        for ($i=0;$i<$this->lengh;$i++){
            //1、验证码x轴的坐标
            //2、将画布i等分，用画布的宽度/字体的个数再乘以$i，就可得出每个文字的X轴位置，最后加30是为了更美观
            $x = $this->width / $this->lengh * $i +30;
            //1、验证码y轴坐标
            //2、用画布的高度+字体的高度再除以2，就可得出每个文字的Y轴位置，让文字垂直居中显示，为了美观
            $y = ($this->height + $this->size) / 2;
            //1、文字的随机颜色
            //2、一种颜色过于单一，也是为了增加验证码的难度，为了验证码更美观
            $color = imagecolorallocatealpha($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),40);
            //1、随机文字
            //2、为了每次随机出现文字源中的文字，避免验证码过于简单
            $text = $this->fontStr[mt_rand(0,strlen($this->fontStr)-1)];
            //1、将每次随机出现的验证码链接起来
            //2、用来将验证码连接起来，存入字符串文件中
            $code .=$text;
            //1、将字写入画布中
            //2、在画布中将文字显示出来，形成验证码
            imagettftext($this->img,$this->size,mt_rand(-45,45),$x,$y,$color,'./lib/font.ttf',$text);
        }
        //1、将链接起来的验证码，存储在./string.txt中
        //2、为了可以与用户填写的验证码进行比对，以便判断用户填写的是否正确
        $_SESSION['code'] = strtolower($code);
    }

    /**
     * 1、制造干扰的方法
     * 2、如果验证码太清晰了那么很容易被机器识别，可能向我们的数据库灌入无用的数据
     */
    private function makeTrouble(){
        //绘制空心圆干扰
        for ($i = 0;$i < 10;$i++){
            //1、空心圆的随机颜色
            //2、增强干扰项的难度，同时一种颜色也很单调
            $color = imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            //画空心圆
            imageellipse($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,30),mt_rand(0,30),$color);
        }
        //绘制密集点干扰
        for ($i=0;$i<3000;$i++){
            $x = mt_rand(0,400);
            $y = mt_rand(0,150);
            //1、密集点的随机颜色
            //2、增强干扰项的难度，同时一种颜色也很单调
            $color = imagecolorallocatealpha($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),80);
            //画密集点
            imagesetpixel($this->img,$x,$y,$color);
        }
        //绘制乱线干扰
        for ($i = 0;$i < 20;$i++){
            $x1 = mt_rand(0,400);
            $y1 = mt_rand(0,150);
            $x2 = mt_rand(0,400);
            $y2 = mt_rand(0,150);
            //1、乱线的随机颜色
            //2、增强干扰项的难度，同时一种颜色也很单调
            $lineColor = imagecolorallocatealpha($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),80);
            //画线
            imageline($this->img,$x1,$y1,$x2,$y2,$lineColor);
        }
    }

    /**
     * 1、输出图像并销毁的方法
     */
    private function showDestory(){
        //1、输出图像
        //2、显示验证码图像
        imagepng($this->img);
        //1、释放图像资源
        //2、避免浪费资源
        imagedestroy($this->img);
    }


}

