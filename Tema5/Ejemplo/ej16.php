<?php

// Definir baraja de cartas
$suits = ['corazones', 'diamantes', 'tréboles', 'picas'];
$values = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$deck = [];

foreach ($suits as $suit) {
    foreach ($values as $value) {
        $deck[] = ["value" => $value, "suit" => $suit];
    }
}

// Función para mezclar y repartir cartas
function dealCards(&$deck, $numCards) {
    $hand = [];
    for ($i = 0; $i < $numCards; $i++) {
        $randomKey = array_rand($deck);
        $hand[] = $deck[$randomKey];
        unset($deck[$randomKey]);
    }
    return $hand;
}

// Mezclar la baraja y repartir cartas
shuffle($deck);
$player1Hand = dealCards($deck, 2);
$player2Hand = dealCards($deck, 2);
$communityCards = dealCards($deck, 3);

// Función para obtener el valor numérico de una carta
function getCardValue($card) {
    if (is_numeric($card)) return $card;
    switch ($card) {
        case 'J': return 11;
        case 'Q': return 12;
        case 'K': return 13;
        case 'A': return 14;
    }
}

// Función para evaluar manos
function evaluateHand($hand) {
    $values = array_map('getCardValue', array_column($hand, 'value'));
    $counts = array_count_values($values);

    $pairs = $trios = $poker = 0;
    foreach ($counts as $value => $count) {
        if ($count == 2) $pairs++;
        if ($count == 3) $trios++;
        if ($count == 4) $poker++;
    }

    if ($poker) return 'Poker';
    if ($trios) return 'Trio';
    if ($pairs == 2) return 'Doble Pareja';
    if ($pairs == 1) return 'Pareja';
    return 'Carta Alta';
}

// Evaluar cada mano
$player1BestHand = evaluateHand(array_merge($player1Hand, $communityCards));
$player2BestHand = evaluateHand(array_merge($player2Hand, $communityCards));

// Mostrar las manos y las cartas de la mesa
echo "Jugador 1: \n";
print_r($player1Hand);
echo "Jugador 2: \n";
print_r($player2Hand);
echo "Cartas de la mesa: \n";
print_r($communityCards);

echo "\nResultado:\n";
echo "Jugador 1: $player1BestHand\n";
echo "Jugador 2: $player2BestHand\n";

// Determinar el ganador
$rankings = ['Carta Alta' => 1, 'Pareja' => 2, 'Doble Pareja' => 3, 'Trio' => 4, 'Poker' => 5];
if ($rankings[$player1BestHand] > $rankings[$player2BestHand]) {
    echo "¡Gana el Jugador 1!";
} elseif ($rankings[$player1BestHand] < $rankings[$player2BestHand]) {
    echo "¡Gana el Jugador 2!";
} else {
    echo "Empate.";
}

?>
