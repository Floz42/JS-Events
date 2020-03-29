<?

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class StatsService
{
    private $manager; 
    
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
        
    /**
     * getSliderCount -> get the total entriy in ImageSlider
     *
     * @return number
     */
    public function getSliderCount()
    {
        return $this->manager->createQuery('SELECT COUNT(s) FROM App\Entity\ImageSlider s')->getSingleScalarResult();
    }
    
    /**
     * getNewsCount -> get the total of news published
     *
     * @return void
     */
    public function getNewsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(n) FROM App\Entity\News n')->getSingleScalarResult();
    }
    
    /**
     * getRatingsCount -> get the total of ratings received
     *
     * @return void
     */
    public function getRatingsCount()
    {
        return $this->manager->createQuery('SELECT count(r) FROM App\Entity\Rating r')->getSingleScalarResult();
    }
    
    /**
     * getDeliveriesCount -> get the total of deliveries posted
     *
     * @return void
     */
    public function getDeliveriesCount()
    {
        return $this->manager->createQuery('SELECT COUNT(d) FROM App\Entity\Delivery d')->getSingleScalarResult();
    }

    /**
     * getVisitor -> serve to count visitors and unique visitors
     *
     * @param  mixed $cookie
     * @param  mixed $fileName
     * @return void
     */
    public function addVisitor($cookie, $fileName)
    {
        if (!isset($_COOKIE[$cookie])) {
            $countVisitorFile = dirname(__DIR__ ) . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . $fileName;
            $counter = 1;
            if (file_exists($countVisitorFile)) {
                $counter = (int)file_get_contents($countVisitorFile);
                $counter++;
            } 
            file_put_contents($countVisitorFile, $counter);
        }
    }

    public function getVisitors($fileName)
    {
        $filename = dirname(__DIR__ ) . DIRECTORY_SEPARATOR . 'Data' . DIRECTORY_SEPARATOR . $fileName;
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        return $contents;
    }

    /**
     * getStats -> return all stats in an array
     *
     * @return void
     */
    public function getStats() 
    {
        $slider = $this->getSliderCount();
        $news = $this->getNewsCount();
        $ratings = $this->getRatingsCount();
        $deliveries = $this->getDeliveriesCount();
        $visitors = $this->getVisitors("counterVisitors");
        $uniqueVisitors = $this->getVisitors("counterUniqueVisitors");
        return compact('slider','news','ratings','deliveries','visitors','uniqueVisitors');
    }
}