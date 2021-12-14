/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/footer.js":
/*!***************************************!*\
  !*** ./resources/assets/js/footer.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(document).ready(function () {\n  $(window).scroll(function () {\n    $(this).scrollTop() > 40 ? $(\"#scroll-top\").fadeIn() : $(\"#scroll-top\").fadeOut();\n  }), $(\"#scroll-top\").click(function () {\n    $(\"html, body\").animate({\n      scrollTop: 0\n    }, 1e3);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2Zvb3Rlci5qcz9jOGVlIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwid2luZG93Iiwic2Nyb2xsIiwic2Nyb2xsVG9wIiwiZmFkZUluIiwiZmFkZU91dCIsImNsaWNrIiwiYW5pbWF0ZSJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQ0MsUUFBRCxDQUFELENBQVlDLEtBQVosQ0FBbUIsWUFBVTtBQUFDRixHQUFDLENBQUNHLE1BQUQsQ0FBRCxDQUFVQyxNQUFWLENBQWtCLFlBQVU7QUFBQ0osS0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRSyxTQUFSLEtBQW9CLEVBQXBCLEdBQXVCTCxDQUFDLENBQUMsYUFBRCxDQUFELENBQWlCTSxNQUFqQixFQUF2QixHQUFpRE4sQ0FBQyxDQUFDLGFBQUQsQ0FBRCxDQUFpQk8sT0FBakIsRUFBakQ7QUFBNEUsR0FBekcsR0FBNEdQLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJRLEtBQWpCLENBQXdCLFlBQVU7QUFBQ1IsS0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQlMsT0FBaEIsQ0FBd0I7QUFBQ0osZUFBUyxFQUFDO0FBQVgsS0FBeEIsRUFBc0MsR0FBdEM7QUFBMkMsR0FBOUUsQ0FBNUc7QUFBNkwsQ0FBM04iLCJmaWxlIjoiLi9yZXNvdXJjZXMvYXNzZXRzL2pzL2Zvb3Rlci5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIiQoZG9jdW1lbnQpLnJlYWR5KChmdW5jdGlvbigpeyQod2luZG93KS5zY3JvbGwoKGZ1bmN0aW9uKCl7JCh0aGlzKS5zY3JvbGxUb3AoKT40MD8kKFwiI3Njcm9sbC10b3BcIikuZmFkZUluKCk6JChcIiNzY3JvbGwtdG9wXCIpLmZhZGVPdXQoKX0pKSwkKFwiI3Njcm9sbC10b3BcIikuY2xpY2soKGZ1bmN0aW9uKCl7JChcImh0bWwsIGJvZHlcIikuYW5pbWF0ZSh7c2Nyb2xsVG9wOjB9LDFlMyl9KSl9KSk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/js/footer.js\n");

/***/ }),

/***/ 5:
/*!*********************************************!*\
  !*** multi ./resources/assets/js/footer.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\Applications\Hype\Gesture\ERP\resources\assets\js\footer.js */"./resources/assets/js/footer.js");


/***/ })

/******/ });