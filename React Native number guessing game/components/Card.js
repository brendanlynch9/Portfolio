import React from 'react';
import {View, StyleSheet} from 'react-native';

//what the below does is it merges the styles below on this.js with 
//the styles added on any page its called on. For example input container
// on the StartGameScreen.js is merged with the standard "Card" CSS below
const Card = props => {
return (
<View style={{...styles.card, ...props.style}}>{props.children}</View>
);
};

const styles = StyleSheet.create({
    card:{
   
        shadowColor: 'black',
        shadowOffset:{width: 0, height: 2},
        shadowRadius: 6,
        shadowOpacity: 0.26,
       // in order for shadows to work on android devices you must use elevation
       elevation: 5,
        backgroundColor: 'white',
        padding:20,
        borderRadius: 10
    },

});

export default Card;