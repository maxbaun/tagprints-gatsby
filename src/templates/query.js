import graphql from 'graphql';

export const Page = graphql`
fragment Page on wordpress__PAGE {
  id,
  content,
  title,
  date(formatString: "MMMM DD, YYYY")
  yoast {
	  title
	  description: metadesc
	  keywords: metakeywords
  }
}
`;

export const Site = graphql`
fragment Site on Site {
  id
  siteMetadata {
	title
	subtitle
  }
}
`;
