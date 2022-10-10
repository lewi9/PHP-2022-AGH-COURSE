<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    public function seeChessboard($rows, $columns)
    {
        $this->seeNumberOfElements("a", $columns*$rows);

        for ($x = 0; $x < $columns; $x = $x+1) {
            for ($z = 0; $z < $rows; $z = $z+1) {
                $this->seeElement("a", ["href" => "?x=$x&z=$z"]);
            }
        }
    }

    public function dontSeeChessboard()
    {
        $this->seeNumberOfElements("a", 0);
    }

    public function seeChessboardPattern($pattern)
    {
        $count = 0;

        for ($z = 0; $z < sizeof($pattern); $z++) {
            $count = $count + sizeof($pattern[$z]);
            for ($x = 0; $x < sizeof($pattern[$z]); $x++) {
                $color = $pattern[$z][$x] == 0 ? "gray" : "white";
                $this->seeElement("a", ["href" => "?x=$x&z=$z", "class" => "block $color"]);
            }
        }

        $this->seeNumberOfElements("a", $count);
    }

}
