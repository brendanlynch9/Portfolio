import React, {useState} from 'react';
import { StyleSheet, View } from 'react-native';
import Header from './components/Header';
import StartGameScreen from './screens/StartGameScreen';
import GameScreen from './screens/GameScreen';
import GameOverScreen from './screens/GameOverScreen';

export default function App() {
// the below lets us load whichever screen we need
const [userNumber, setUserNumber ] = useState();
//the below keeps track of the number of rounds to finish game. initially 0
const [guessRounds, setGuessRounds]= useState(0);
//start a new game
const configureNewGameHandler = () => {
setGuessRounds(0);
setUserNumber(null);
};


const startGameHandler =(selectedNumber) => {
  setUserNumber(selectedNumber);
};

const gameOverHandler = numOfRounds => {
setGuessRounds(numOfRounds);
};

// tells the app this is the default start screen
let content= <StartGameScreen onStartGame={startGameHandler}/>;
//however if we have a userNumber then go to GameScreen
if (userNumber && guessRounds <= 0){
  content= <GameScreen userChoice={userNumber} onGameOver={gameOverHandler}/>;
}else if (guessRounds > 0) {
  content = <GameOverScreen  roundsNumber={guessRounds} userNumber={userNumber} onRestart={configureNewGameHandler}/>;
}
  return (
    <View style={styles.screen}>
      <Header title="Guess a number" />
      {content}
    </View>
  );
}

const styles = StyleSheet.create({
screen:{
  flex:1
}
});
