<?php


namespace App\Service;


use App\Entity\Combustibles;
use App\Entity\ModelYear;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Marcas;
use Symfony\Component\DomCrawler\Crawler;

class actualizarMarcas
{
    private $em;
    private $wsBaseUrl;
    private $tmpFileFromSource;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->wsBaseUrl = "https://www.coches.net/ws/Dictionary.asmx/";
        $this->tmpFileFromSource = "tmp/sourceFile";
        file_put_contents(
            $this->tmpFileFromSource,$this->restClient("https://www.coches.net/tasacion-de-coches.aspx")
        );
    }

    public function restClient($url,$type = "raw")
    {
        $cookie = "cookie.txt";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('authority: suchen.mobile.de', 'path: /fahrzeuge/search.html?damageUnrepaired=NO_DAMAGE_UNREPAIRED&isSearchRequest=true&maxPowerAsArray=PS&minPowerAsArray=PS&scopeId=C', 'scheme: https', 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8', 'accept-encoding: gzip, deflate, br', 'accept-language: en-US,en;q=0.9', 'upgrade-insecure-requests: 1'));
        $data = curl_exec ($ch);

        if ($type == "raw")
            return $data;
        else
            return json_decode($data);
    }

    public function getMarcasFromSource()
    {
        $status = false;
        $crawler = new Crawler(file_get_contents($this->tmpFileFromSource));

        $nodeValues = $crawler
            ->filter('body')->
            filterXPath('//select[contains(@id, "_ctl0_ContentPlaceHolder1_Marca")]')->
            //filter("select")->
            filter("option")->
            each(function (Crawler $node, $i) {
            return $node;
        });
        foreach($nodeValues as $node)
        {
            $marcas = new Marcas();
            $marcas->setMarca($node->text());
            $marcas->setIdMarca($node->attr("value"));
            $this->em->persist($marcas);

        }
        $this->em->flush();
        //return $status;
    }

    public function createYearsDB(){

        for ($i = 2000;$i <= date("Y")+1;$i++)
        {
            $year = new ModelYear();
            $year->setYear($i);
            $this->em->persist($year);
        }
        $this->em->flush();

    }

    public function getCombustiblesFromSource()
    {
        $crawler = new Crawler(file_get_contents($this->tmpFileFromSource));

        $nodeValues = $crawler
            ->filter('body')->
            filterXPath('//select[contains(@id, "_ctl0_ContentPlaceHolder1_Combustible")]')->
            //filter("select")->
            filter("option")->
            each(function (Crawler $node, $i) {
                return $node;
            });
        foreach($nodeValues as $node)
        {
            $combustibles = new Combustibles();
            $combustibles->setTipo($node->text());
            $combustibles->setIdCombustible($node->attr("value"));
            $this->em->persist($combustibles);

        }
        $this->em->flush();

    }

    public function volcarModelosFromSource()
    {
        set_time_limit(0);
        $wsGet = "Model_by_Makeid_JSON?MakeId=7&Section1Id=2500&Section2Id=0&Section3Id=0";

        $wsParams  = "";
        $wsParams .= "&FuelTypeId="; 


        //Model_by_Makeid_JSON?MakeId=7&Section1Id=2500&Section2Id=0&Section3Id=0
        //&FuelTypeId=1&ModelYear=2000&_=1573059480621";
    }

    public function doTheJob()
    {

    }
}