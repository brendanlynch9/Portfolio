import React, {useState} from 'react';
import { 
  StyleSheet,
   Text,
    View,
     Button,  
     FlatList } from 'react-native';
import GoalItem from './components/GoalItem';
import GoalInputs from './components/GoalInput';

export default function App() {

const [courseGoals, setCourseGoals] = useState ([]);
const[isAddMode, setIsAddMode] = useState(false);
//our course goals is an array of objects that each object has a id & value
const addGoalHandler = goalTitle => {
 setCourseGoals(currentGoals =>[
   ...courseGoals,
    {id: Math.random().toString(), value:goalTitle}
  ]);
  setIsAddMode(false);
};

const removeGoalHandler = goalId => {
  setCourseGoals(currentGoals => {
    return currentGoals.filter((goal)=> goal.id !==goalId);
  });
}

const cancelGoalAdditionHandler = () =>{
  //setisaddmode to false closes the modal
setIsAddMode(false);
};
  return (
    <View style={styles.screen}>
      <Button title= "Add New Goal" onPress= {() => setIsAddMode(true)} />
        <GoalInputs 
        visible={isAddMode} 
        onAddGoal= {addGoalHandler} 
        onCancelGoal= {cancelGoalAdditionHandler}/>
        {/* flatlist requires an id and value for each item */}
        {/* keyextractor tells flatlist how to extract the id  */}
        <FlatList 
        keyExtractor={(item, index) => item.id}
        data={courseGoals} 
        renderItem={itemData => 
        <GoalItem 
        id={itemData.item.id} 
        onDelete={removeGoalHandler} 
        title={itemData.item.value}/>}
        />    
      </View>
  );
}

const styles = StyleSheet.create({
  screen: {
    padding:50
  },
 
});
