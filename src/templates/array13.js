import React from 'react';
import graphql from 'graphql';
import {Page, Site} from './query';
import UTIL from '../scripts/main';
import Meta from '../components/meta';

export default class Array13Template extends React.Component {
	componentDidMount() {
		UTIL.loadEvents();
	}

	render() {
		const siteMetadata = this.props.data.site.siteMetadata;
		const currentPage = this.props.data.wordpressPage;
		const yoast = currentPage.yoast;

		return (
			<div>
				<Meta {...yoast}/>
				<div
					dangerouslySetInnerHTML={{__html: currentPage.content}} // eslint-disable-line react/no-danger
				/>
			</div>
		);
	}
}

export const pageQuery = graphql`
  query array13TemplateQuery($id: String!) {
    wordpressPage(id: { eq: $id }) {
      ...Page
    }
    site {
      ...Site
    }
  }
`;
