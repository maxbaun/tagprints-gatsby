import React from 'react';
import graphql from 'graphql';
import {fromJS} from 'immutable';

export default class Home extends React.Component {
	render() {
		const page = this.props.data ? fromJS(this.props.data.wordpressPage) : fromJS({});

		return (
			<div>
				<div
					dangerouslySetInnerHTML={{__html: page.get('content')}} // eslint-disable-line react/no-danger
				/>
			</div>
		);
	}
}

export const pageQuery = graphql`
query HomePage {
  wordpressPage(wordpress_id: {eq: 5}) {
    content
  }
}
`;
