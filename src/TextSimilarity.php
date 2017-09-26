<?php
namespace OffAxis;

class TextSimilarity {


    /*
     * Return average level of similiraty between 2 texts (0 is totally different, 1 is equal)
     */
    public static function compare($first, $second) {
        if( !$first || !$second ) {
            return 0;
        }

        if( $first === $second ) {
            return 1;
        }

        return (
                self::levenshtein($first, $second)
                + self::jaroWinkler($first, $second)
                + self::smithWatermanGotoh($first, $second)
                + self::jaccard($first, $second)
                + self::similarText($first, $second)
            ) / 5;
    }


    public static function levenshtein($first, $second) {
        return levenshtein($first, $second);
    }


    public static function jaroWinkler($first, $second) {
        return webd\language\StringDistance::JaroWinkler($first, $second);
    }

    public static function jaro($first, $second) {
        return webd\language\StringDistance::Jaro($first, $second);
    }

    public static function jaccard($first, $second) {
        return TextCategorization\JaccardIndex::getSimilarity($first, $second);
    }


    public static function smithWatermanGotoh($first, $second) {
        $smg = new OffAxis\TextSimilarity\SmithWatermanGotoh();
        return $smg->compare($first, $second);
    }


    public static function similarText($first, $second) {
        similar_text($first, $second, $percent1);
        similar_text($second, $first, $percent2);
        return (($percent1 + $percent2) / 2) / 100;
    }

}
