import React, {useState, useRef, useEffect}from 'react';
import {View, Text, StyleSheet, Button, Alert} from 'react-native';

import NumberContainer from '../components/NumberContainer';
import Card from '../components/Card';

//generate a random number
const generateRandomBetween = (min, max, exclude) => {
    min= Math.ceil(min);
    max= Math.floor (max);
    const rndNum =Math.floor(Math.random() * (max-min)) + min;
    if (rndNum === exclude) {
        return generateRandomBetween(min, max, exclude);
    } else{
        return rndNum;
    }
};


const GameScreen = props => {
    const [currentGuess, setCurrentGuess] = useState(
        generateRandomBetween(1, 100, props.userChoice)
    );
        //useRef is the "state" of the input boundaries in this case 
        //a number between 1 and 100
        const [rounds, setRounds] = useState(0);
        const currentLow = useRef(1);
        const currentHigh = useRef(100);
//the below adds "props." to the items between {}.. its called destructuring
        const {userChoice, onGameOver} = props;
//this helps end the game.
        useEffect (() =>{
            if (currentGuess === userChoice){
                onGameOver(rounds);
            }
        }, [currentGuess, userChoice, onGameOver ]);

//the logic for the lesser and greater buttons

const nextGuessHandler = direction => {
    //validate that the button pushed is correct
 if ((direction === 'lower' && currentGuess < props.userChoice) || 
 (direction === 'greater' && currentGuess > props.userChoice)
 ) {
    Alert.alert('Don\'t Lie!', 'You know this is wrong...', [
        {text:'Sorry!', style:'cancel'}
    ]);
    return;
}
//after validated then this is executed
if (direction === 'lower') {
    currentHigh.current = currentGuess;
}else{
    currentLow.current= currentGuess;
}
const nextNumber = generateRandomBetween(currentLow.current, currentHigh.current, currentGuess );
setCurrentGuess(nextNumber);
setRounds (curRounds => curRounds + 1);
};

return (
<View style={styles.screen}>
    <Text>Opponent's Guess</Text>
<NumberContainer>{currentGuess}</NumberContainer>
<Card style={styles.buttonContainer}>
<Button title="LOWER" onPress={nextGuessHandler.bind(this, 'lower')}/>
<Button title="GREATER" onPress={nextGuessHandler.bind(this, 'greater')} />
</Card>
</View>
);

};

const styles = StyleSheet.create ({
    screen:{
        flex: 1,
        padding: 10,
        alignItems: 'center'
    },
    buttonContainer:{
        flexDirection: 'row',
        justifyContent: 'space-around',
        marginTop: 20,
        width: 300,
        maxWidth:'80%'
    }
});

export default GameScreen;