<?php

class Xparser 
{ 
    
    public $filename ='';
    public $wordsLibery = array();

    /** 
     * Preparation 
     * 
     * @param $filename String 
     * @param $filename Bulian 
     */ 
    public function __construct ($filename) 
    { 
        if (file_exists ($filename)) 
        { 
            $this->filename = $filename;
            $i = 0;
            $handle = @fopen($filename, "r");
            if ($handle) {
                while (($buffer = fgets($handle, 4096)) !== false) {
                    if ($i == 0) { $i++; continue; }

                    $array = explode(',',$buffer);
                    $line['Keyword']=$array[0];
                    $line['Searches']=$array[1];
                    $this->parse($line);

                }
                if (!feof($handle)) {
                    echo "Error: unexpected fgets() fail\n";
                }
                fclose($handle);
            }
        } 
        else 
        { 
            throw new Exception("File $filename not found"); 
        } 
    } 

    public function getResults(){
        return $this->wordsLibery;
    }

    public function writeResults(){

        print "Word,Count,Total Broad Searches,Total Exact Searches\n"; 
        foreach ($this->wordsLibery as $key=>$word) {
            print $key.','.$word['Count'].','.$word['Total'].','.$word['TotalExactSearches'].','.$word['totalBroadSearches']."\n";
        }
    }


    private function parse($line)
    {
        if(strpos($line['Keyword'], ']')){
            $temp = substr($line['Keyword'],1);
            $temp = substr($temp,0,-1);
            $words = explode(' ', $temp);
            foreach ($words as $word) {
                if (isset($this->wordsLibery[$word])) {
                    $this->wordsLibery[$word]['Count']++;
                    $this->wordsLibery[$word]['Total']=$this->wordsLibery[$word]['Total']+$line['Searches'];
                    $this->wordsLibery[$word]['TotalExactSearches'] = $this->wordsLibery[$word]['TotalExactSearches']+$line['Searches'];
                }else{
                    $this->wordsLibery[$word]['Count'] = 1;
                    $this->wordsLibery[$word]['Total']=(int) $line['Searches'];
                    $this->wordsLibery[$word]['TotalExactSearches']=(int) $line['Searches'];
                    $this->wordsLibery[$word]['totalBroadSearches']=0;
                }
            }
        }else{
            $words = explode(' ', $line['Keyword']);
            foreach ($words as $word) {
                if (isset($this->wordsLibery[$word])) {
                    $this->wordsLibery[$word]['Count']++;
                    $this->wordsLibery[$word]['totalBroadSearches']=$this->wordsLibery[$word]['totalBroadSearches']+$line['Searches'];
                    $this->wordsLibery[$word]['Total']=$this->wordsLibery[$word]['Total']+$line['Searches'];
                }else{
                    $this->wordsLibery[$word]['Count'] = 1;
                    $this->wordsLibery[$word]['Total']=(int) $line['Searches'];
                    $this->wordsLibery[$word]['totalBroadSearches']= (int) $line['Searches'];
                    $this->wordsLibery[$word]['TotalExactSearches']=0;
                }
            }
        }
    }

} 