import React, { Component } from 'react';

class LettersList extends Component {
    
    render() {
        return (
        <>
            {this.props.list.map((item, index, {length}) =>
                <React.Fragment key={ index }>
                    <span style={ {color: (item.exists ? 'green' : 'red')} }> { item.letter }</span>{ index + 1 === length ? '' : ','}
                </React.Fragment>
            )}
        </>
    )
    }
}

export default LettersList;