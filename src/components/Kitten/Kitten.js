import kind from '@enact/core/kind';
import PropTypes from 'prop-types';
import React from 'react';

import css from './Kitten.less';
import Spottable from '@enact/spotlight/Spottable';

const KittenBase = kind({
  name: 'Kitten',

  propTypes: {
    children: PropTypes.string,
    index: PropTypes.number,
    size: PropTypes.number,
    onSelect: PropTypes.func,
  },

  defaultProps: {
    size: 300
  },

  styles: {
    css,
    className: 'kitten'
  },

  handlers: {
    onSelect: (ev, {index, onSelect}) => {
      if (onSelect) {
        onSelect({index});
      }
    }
  },

  computed: {
    url: ({index, size}) => {
      return `//loremflickr.com/${size}/${size}/kitten?random=${index}`;
    }
  },

  render: ({children, onSelect, url, ...rest}) => {
    delete rest.index;
    delete rest.size;

    return (
      <div {...rest} onClick={onSelect}> {/*<div index="0" size="300" class="kitten"*/}
        <img src={url}/>
        <div>{children}</div>
      </div>
    );
  }
});

const Kitten = Spottable(KittenBase);

export default KittenBase;
export {KittenBase as Kitten};