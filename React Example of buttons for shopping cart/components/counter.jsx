import React, { Component } from "react";

class Counter extends Component {
  // Updating Phase
  componentDidUpdate(prevProps, prevState) {
    console.log("prevProps", prevProps);
    console.log("prevState", prevState);
    // if (prevProps.counter.value !== this.props.counter.value){
    // Ajax call and get new data from the server
    // }
  }
  // Unmounting Phase
  componentWillUnmount() {
    console.log("counter-Unmount");
  }

  render() {
    // mounting phase
    console.log("Counter-Rendered");
    return (
      <div>
        <span className={this.getBadgeClasses()}>{this.formatCount()}</span>
        <button
          onClick={() => this.props.onIncrement(this.props.counter)}
          className="btn btn-secondary btn-sm"
        >
          Increment
        </button>
        <button
          onClick={() => this.props.onDelete(this.props.counter.id)}
          className="btn btn-danger btn-sm m-2"
        >
          Delete
        </button>
      </div>
    );
  }
  // the function below will render the counter yellow if
  //  the count is at 0 or blue if the count is at 1
  getBadgeClasses() {
    let classes = "badge m-2 badge-";
    classes += this.props.counter.value === 0 ? "warning" : "primary";
    return classes;
  }

  formatCount() {
    const { value } = this.props.counter;
    return value === 0 ? "Zero" : value;
  }
}
export default Counter;
